<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/connexion.css">
    <title>create.php</title>
</head>

<body>
    <?php
       $numEmplo = $passwd = $recoverEmail = $prenom = $nom = "";
       $errorNumEplo = $errorPasswd = $errorRecoverEmail = $errorPrenom = $errorNom = "";
       $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        if (empty($_POST['passwd'])) {
            $errorRecoverEmail = "Email de récupération manquant";
            $erreur = true;
        } else {
            $recoverEmail = test_input($_POST["recoverEmail"]);
        }
        if (empty($_POST['prenom'])) {
            $errorPrenom = "Prénom manquant";
            $erreur = true;
        } else {
            $prenom = test_input($_POST["prenom"]);
        }
        if (empty($_POST['nom'])) {
            $errorNom = "Nom manquant";
            $erreur = true;
        } else {
            $nom = test_input($_POST["nom"]);
        }

        // Inserer dans la base de données
        if ($erreur != true) {
            $numEmplo = $_POST['numEmplo'];
            $recoverEmail = $_POST['recoverEmail'];
            $passwd = $_POST['passwd'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $passwd = sha1($passwd, false);

            $servername = "localhost";
            $usernameBD = "root";
            $passwordBD = "root";
            $bd = "smileyFace";

            $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO user (numEmploye, password, prenom, nom, recoverEmail) 
            VALUES ('$numEmplo', '$passwd', '$prenom', '$nom', '$recoverEmail')";
            $conn->query('SET NAMES utf8');
            if (mysqli_query($conn, $sql)) {
                echo "Enregistrement réussi";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            header("Location: eventBD.php");
            mysqli_close($conn); 
    ?>
        <?php
            }
        }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        ?>
         <div class="container-fluid h-100 d-flex flex-column">
            <div class="row top-left test1">
                <div class="col-1 p-0 m-0">
                   <button type="button" class="btn" id="butBack" onclick="window.location.href='eventBD.php'">Revenir</button>
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
                            <label for="recoverEmail">Recovery Email</label>
                            <input type="text" class="form-control" placeholder="Email de récupération" name="recoverEmail">
                            <span><?php echo $errorRecoverEmail; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom">
                            <span><?php echo $errorPrenom; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" placeholder="Nom" name="nom">
                            <span><?php echo $errorNom; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="passwd">Mot de passe</label>
                            <input type="password" class="form-control" placeholder="Mot de passe" name="passwd">
                            <span><?php echo $errorPasswd; ?></span>
                        </div>
                        <div class="middle">
                        <button type="submit" class="btn btn-success mt-2 maxlargeur">Créer</button>
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