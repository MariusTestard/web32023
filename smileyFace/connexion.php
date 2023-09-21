<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Connexion - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $_SESSION["connexion"] = false;
    }
    if ($_SESSION["connexion"] == false) {
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

            if ($erreur != true) {
                $servername = "localhost";
                $usernameBD = "root";
                $passwordBD = "root";
                $bd = "smileyFace";

                $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SI NUM ET MDP SAME   
                /*
                if($numEmplo == $password){
                    //$sql = "SELECT * FROM user WHERE numEmploye = '$numEmplo' AND password = '$passwd'";
                    //POP-UP
                    $prompt_msg = "Veuillez changez votre mot de passe par défaut.";
                    $passwd = sha1(prompt($prompt_msg), false);
                    $sql = "UPDATE user SET password = '$passwd' WHERE numEmploye = '$numEmplo'";
                    $conn->query($sql);
                    //header("Location: connexion.php");
                }
                */
                $passwd = sha1($passwd, false);
                $sql = "SELECT * FROM user WHERE numEmploye = '$numEmplo' AND password = '$passwd'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1>Connecté</h1>";
                    $_SESSION["connexion"] = true;
                    $_SESSION['EventFirstCo'] = true;
                    $_SESSION["nom"] = $row['nom'];
                    $_SESSION["prenom"] = $row['prenom'];

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
            <div class="container-fluid h-100 d-flex flex-column">
                <div class="row top-left test1">
                    <div class="col-1 p-0 m-0">
                        <button type="button" class="btn" id="butBack" onclick="window.location.href='index.php'">Revenir</button>
                    </div>
                </div>
                <div class="row middle test99 flex-grow-1 d-flex">
                    <div class="col-2 my-form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="numEmplo">N° Employé</label>
                                <input type="text" class="form-control" placeholder="N° Employé" name="numEmplo">
                                <span><?php echo $errorNumEplo; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="passwd">Mot de passe</label>
                                <input type="password" class="form-control" placeholder="Mot de passe" name="passwd">
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
    function prompt($prompt_msg)
    {
        echo ("<script type='text/javascript'> var answer = prompt('" . $prompt_msg . "'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return ($answer);
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>