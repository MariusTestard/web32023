<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/css/butterCake.min.css">
    <link rel="stylesheet" href="css/mail.css">
    <title>Mot de passe oublié - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    $recoverEmail = "";
    $errorRecoverEmail = "";
    $erreur = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['recoverEmail'])) {
            $errorRecoverEmail = "Courriel de récupération manquant";
            $erreur = true;
        } else {
            $recoverEmail = test_input($_POST["recoverEmail"]);
        }

        if ($erreur != true) {
            require("connexionServeur.php");
            $conn = new mysqli($servername, $username, $password, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $sql = "SELECT numEmploye, recoverEmail FROM user";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row["recoverEmail"] == $recoverEmail) {
                            $_SESSION['numPlo'] = $row["numEmploye"];
                            $numPlo = $_SESSION['numPlo'];
                            $errorRecoverEmail = "";
                            $_SESSION["ConnectionFirst"] = true;
                            header("Location: newPass.php?id=$numPlo&choice=1");
                        } else {
                            $errorRecoverEmail = "Ce courriel n'est liée à aucun compte";
                    $erreur = true;
                        }
                    }
                }
            }
            mysqli_close($conn);
    ?>
        <?php
        }
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        ?>
        <section class="login-page flex-center-center py-5 bg-light">
            <div class="w-100 mx-auto px-2" style="max-width: 400px">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="text-center text-gray">
                        <h2 class="weight-500 mb-1">Mot de passe oublié</h2>
                        <p class="h4 mb-2 weight-300 ">Entrez le courriel pour une redirection</p>
                    </div>
                    <div class="card overflow-unset mt-9 mb-1">
                        <div class="card-body">
                            <div class="avatar-icon text-center">
                                <img src="img/tr.jpg" height="128" width="128" alt="Avatar" class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
                                <a href="userBD.php" id="back">&#10132;</a>
                            </div>
                            <div class="group">
                                <label for="recoverEmail">Courriel de récupération</label>
                                <input type="email" class="input" placeholder="Courriel de récupération" name="recoverEmail" value="">
                                <span class="spanErr"><?php echo $errorRecoverEmail; ?></span>
                            </div>
                            <div class="group">
                                <button class="btn btncolor block btn-lg weight-500" type="submit">Envoyer</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center weight-600 text-gray">
                        <a href="help.php?id=7" class="text-gray">Besoin d'aide?</a>
                    </div>
                </form>
            </div>
        </section>
    <?php
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/js/butterCake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>