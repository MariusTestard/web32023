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
    <link rel="stylesheet" href="css/index.css">
    <title>connexion.php</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $_SESSION["connexion"] = false;
    }
    if ($_SESSION["connexion"] == false) {
        //On crée les variables du formulaire vide
        $userOrEmail = $passwd = "";

        //On crée les variables d'erreurs vides
        $errorUserOrEmail = $errorPasswd = "";

        //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Si on entre, on est dans l'envoie du formulaire 
            if (empty($_POST['userOrEmail'])) {
                $errorUserOrEmail = "Le nom d'utilisateur ou l'email est manquant ↑";
                $erreur = true;
            } else {
                $userOrEmail = test_input($_POST["userOrEmail"]);
            }
            if (empty($_POST['passwd'])) {
                $errorPasswd = "Le mot de passe est manquant ↑";
                $erreur = true;
            } else {
                $passwd = test_input($_POST["passwd"]);
            }

            // Inserer dans la base de données
            if ($erreur != true) {
                $userOrEmail = $_POST['userOrEmail'];
                $passwd = $_POST['passwd'];

                $passwd = sha1($passwd, false);

                $servername = "localhost";
                $usernameBD = "root";
                $passwordBD = "root";
                $bd = "phpbd";

                $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM usagers WHERE user = '$userOrEmail' AND passwd = '$passwd'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1>Connecté</h1>";
                    $_SESSION["connexion"] = true;
                    header("Location: index.php");
                } else {
                    $sql = "SELECT * FROM usagers WHERE email = '$userOrEmail' AND passwd = '$passwd'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $_SESSION["connexion"] = true;
                        header("Location: index.php");
                    } else {
                        $erreur = true;
                        $errorPasswd = "Username/Email or password invalide";
                    }
                    $conn->close();
    ?>
            <?php
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            ?>
            <div class="container-fluid h-100">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for=""></label>
                        <input type="text" class="form-control" placeholder="Username or email" name="userOrEmail">
                        <span><?php echo $errorUserOrEmail; ?></span>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="password" class="form-control" placeholder="Password" name="passwd">
                        <span><?php echo $errorPasswd; ?></span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Sign in</button>
                    <a href="compte.php" class="btn btn-primary" role="button">Create account</a>
                </form>
            </div>
    <?php
        }
    } else {
        header("Location: index.php");
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