<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>launch.php</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        $id = $_GET['id'];
        $bool = false;
        $_SESSION['pasEnCours'] = "";
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            require("connexionServeur.php");
            $conn = new mysqli($servername, $username, $password, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT etat FROM event WHERE etat = '1'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['enCours'] = "Un évènement est présentement en cours !";
                $_SESSION['pasEnCours'] = "";
                $bool = true;
            } else {
                $_SESSION['enCours'] = "";
            }
            if ($bool == false) {
                $sql = "UPDATE event SET etat = '1' WHERE idEvent = '$id'";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['pasEnCours'] = "";
                    header("Location: eventBD.php");
                }
            }
            $conn->close();
            header("Location: eventBD.php");
        }
    } else {
        header("Location: connexion.php");
    }
    ?>
</body>

</html>