<?php
/*
session_start();
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/connexion.css">
    <title>connexion.php</title>
</head>
<body>
    <?php
    /*
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $_SESSION["connexion"] = false;
    }
    if ($_SESSION["connexion"] == false) {
        */
        $numEmplo = $passwd = "";
        $errorNumEplo = $errorPasswd = "";
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Si on entre, on est dans l'envoie du formulaire 
            if (empty($_POST['numEmplo'])) {
                $errorNumEplo = "N° employé manquant";
                $erreur = true;
            } else {
                $numEmplo = test_input($_POST["numEmplo"]);
            }
            if (empty($_POST['passwd'])) {
                $errorPasswd = "Mot de passe manquant";
                $erreur = true;
            } else {
                $passwd = test_input($_POST["passwd"]);
            }

            // Inserer dans la base de données
            if ($erreur != true) {
                $servername = "localhost";
                $usernameBD = "root";
                $passwordBD = "root";
                $bd = "smileyFace";

                $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM user WHERE numEmploye = '$numEmplo' AND password = '$passwd'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1>Connecté</h1>";
                    $_SESSION["connexion"] = true;
                    header("Location: eventBD.php");
                } else {
                        $erreur = true;
                        $numEmplo = "";
                        $errorPasswd = "N° Employé ou mot de passe invalide";
                    }
                    $conn->close();
    ?>
        <?php
                }
            }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        ?>
        <div class="container-fluid h-100">
            <div class="row middle h-100">
                <div class="col-2">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="numEmplo">N° Employé</label>
                            <input type="text" class="form-control" placeholder="N° Employé" name="numEmplo">
                            <span><?php echo $errorNumEplo; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="passwd">Mot de passe</label>
                            <input type="password" class="form-control" placeholder="Password" name="passwd">
                            <span><?php echo $errorPasswd; ?></span>
                        </div>
                        <div class="middle">
                        <button type="submit" class="btn btn-success mt-2 maxlargeur">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>