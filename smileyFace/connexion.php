<?php
session_start();
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/css/butterCake.min.css">
    <link rel="stylesheet" href="css/connexion.css">
    <script src="js/connexion.js"></script>
    <title>Connexion - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $_SESSION["connexion"] = false;
        $_SESSION["ConnectionFirst"] = false;
    }
    if ($_SESSION["connexion"] == false) {
        $numEmplo = $passwd = "";
        $errorNumEplo = $errorPasswd = "";
        $erreur = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['numEmplo'])) {
                $errorNumEplo = "Numéro d'employé manquant";
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
            if ($erreur != true) {
                $servername = "localhost";
                $usernameBD = "root";
                $passwordBD = "root";
                $bd = "smileyFace";
                $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if ($numEmplo == $passwd) {
                    echo "LE NUM ET LE PASSWORD ENTRÉS SONT LES MÊMES";
                    $resultNum = $conn->query("SELECT numEmploye, password FROM user WHERE numEmploye = $numEmplo");
                    if ($rowNum = mysqli_fetch_array($resultNum)) {
                        if ($numEmplo == $rowNum['password']) {
                            echo "LE NUM ET LE PASSWORD DANS LA BD SONT LES MÊMES";
                            $_SESSION["ConnectionFirst"] = true;
                            $_SESSION['numPlo'] = $rowNum['numEmploye'];
                            header("Location: newPass.php");
                        } else {
                            $passwd = sha1($passwd, false);
                            $sql = "SELECT * FROM user WHERE numEmploye = '$numEmplo' AND password = '$passwd'";
                            $_SESSION['numPlo'] = $numEmplo;
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo "<h1>Connecté</h1>";
                                $_SESSION["ConnectionFirst"] = false;
                                $_SESSION["connexion"] = true;
                                $_SESSION['EventFirstCo'] = true;
                                $_SESSION["nom"] = $row['nom'];
                                $_SESSION["prenom"] = $row['prenom'];
                                header("Location: eventBD.php");
                            } else {
                                $erreur = true;
                                $numEmplo = "";
                                $errorPasswd = "Numéro d'employé ou mot de passe invalide";
                            }
                        }
                    }
                } else {
                    $passwd = sha1($passwd, false);
                    $sql = "SELECT * FROM user WHERE numEmploye = '$numEmplo' AND password = '$passwd'";
                    $_SESSION['numPlo'] = $numEmplo;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<h1>Connecté</h1>";
                        $_SESSION["ConnectionFirst"] = false;
                        $_SESSION["connexion"] = true;
                        $_SESSION['EventFirstCo'] = true;
                        $_SESSION["nom"] = $row['nom'];
                        $_SESSION["prenom"] = $row['prenom'];
                        header("Location: eventBD.php");
                    } else {
                        $erreur = true;
                        $numEmplo = "";
                        $errorPasswd = "Numéro d'employé ou mot de passe invalide";
                    }
                }
                $conn->close();
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
                            <h2 class="weight-500 mb-1">Connexion</h2>
                            <p class="h4 mb-2 weight-300">Veuillez vous connecter pour continuer</p>
                        </div>
                        <div class="card overflow-unset mt-9 mb-1">
                            <div class="card-body">
                                <div class="avatar-icon text-center">
                                    <img src="https://yt3.ggpht.com/a/AATXAJyBgyVuLbK5tbpbn8yLLYqX2cU0o5GCmDoToA=s900-c-k-c0xffffffff-no-rj-mo" height="128" width="128" alt="Avatar" class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
                                </div>
                                <div class="group">
                                    <label for="numEmplo">Numéro d'employé:</label>
                                    <input type="text" class="input" placeholder="Numéro d'employé" name="numEmplo">
                                    <span class="spanErr"><?php echo $errorNumEplo; ?></span>
                                </div>
                                <div class="group">
                                    <label for="test2">Mot de passe:</label>
                                    <input type="password" class="input" placeholder="Mot de passe" name="passwd">
                                    <span class="spanErr"><?php echo $errorPasswd; ?></span>
                                </div>
                                <div class="group"></div>
                                <div class="group">
                                    <button class="btn btncolor block btn-lg weight-500 test" type="submit">Se connecter</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-center weight-600 text-gray">
                            <a href="" class="text-gray">Mot de passe oublié</a> · <a href="" class="text-gray">Besoin d'aide?</a>
                        </div>
                    </form>
                </div>
            </section>
    <?php
        }
    } else {
        header("Location: userBD.php");
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