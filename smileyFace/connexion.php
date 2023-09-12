<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>connexion.php</title>
</head>
<body>
<?php
    $username = $email = $passwd = "";

    //On crée les variables d'erreurs vides
    $errorUser = $errorEmail = $errorPasswd = "";

    //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Si on entre, on est dans l'envoie du formulaire 
        if (empty($_POST['username'])) {
            $errorUser = "Le nom d'utilisateur est manquant ↑";
            $erreur = true;
        } else {
            $username = test_input($_POST["username"]);
        }  if (empty($_POST['email'])) {
            $errorEmail = "L'email est manquant ↑";
            $erreur = true;
        } else {
            $email = test_input($_POST["email"]);
        } if (empty($_POST['passwd'])) {
            $errorPasswd = "Le mot de passe est manquant ↑";
            $erreur = true;
        } else {
            $passwd = test_input($_POST["passwd"]);
        }

        // Inserer dans la base de données
        if ($erreur != true) {
            $username = $_POST['username'];
            $email = $_POST['email'];
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
            $sql = "INSERT INTO usagers (id, user, email, passwd, ip, machine) 
            VALUES (NULL, '$username', '$email', '$passwd', '', '')";
            $conn->query('SET NAMES utf8');
            if (mysqli_query($conn, $sql)) {
                echo "Enregistrement réussi";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            header("Location: index.php");
            mysqli_close($conn); 
    ?>
        <?php
            }
        }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        ?>
        <div class="container-fluid h-100">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <span><?php echo $errorUser; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Email" name="email">
                    <span><?php echo $errorEmail; ?></span>
                </div>
                <div class="form-group">
                    <label for="passwd">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="passwd">
                    <span><?php echo $errorPasswd; ?></span>
                </div>
                <button type="submit" class="btn btn-success mt-2">Create</button>
            </form>
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
</body>
</html>