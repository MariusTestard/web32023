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
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <title>Password - Cégep de Trois-Rivières</title>
</head>
<body>
<?php 
    if ($_SESSION["connexion"] == true) {
    $numPlo = $_SESSION['numPlo'];
    $passwd = "";
    $errorPasswd = "";
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['newPass'])) {
            $errorPasswd = "Mot de passe manquant";
            $erreur = true;
        } else {
            $passwd = test_input($_POST["newPass"]);
        }
    

    if ($erreur != true) {
        $newPass = sha1($_POST['newPass']);
        $numEmplo = $_SESSION['numPlo'];
        $servername = "localhost";
        $usernameBD = "root";
        $passwordBD = "root";
        $bd = "smileyFace";
        $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd); // Corrected the variable names
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "UPDATE user SET password = '$newPass' WHERE numEmploye = '$numEmplo'";
        
        $conn->query('SET NAMES utf8');
        if ($conn->query($sql) === TRUE) {
            echo "Enregistrement réussi";
            header("Location: connexion.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
        
    }
}

    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
?>
    <div class="container-fluid h-100 d-flex flex-column">
            <div class="row top-left test1">

            </div>
            <div class="row middle test99 flex-grow-1 d-flex">
                <div class="col-2 my-form-container">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>N° Employé</label>
                            <input type="text" class="form-control" value="<?php echo $numPlo ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="newPass">Nouveau mot de passe</label>
                            <input type="password" class="form-control" placeholder="Mot de passe" name="newPass">
                            <span><?php echo $errorPasswd; ?></span>
                        </div>
                        <div class="middle">
                            <button type="submit" class="btn btn-success mt-2 maxlargeur">Changer</button>
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
} else {
    header("Location: connexion.php");
}
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
