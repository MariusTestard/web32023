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
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            //<?php require("connexionServeur.php");
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $bd = "smileyFace";

            $conn = new mysqli($servername, $username, $password, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Etat FROM event WHERE Etat = '1'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "Un évènement est présentement en cours !";
                $bool = true;
            }
            if ($bool == false) {
                $sql = "UPDATE event SET Etat = '1' WHERE idEvent = '$id'";
                if (mysqli_query($conn, $sql)) {
                    header("Location: eventBD.php");
                }
            }
            $conn->close();
        }
    } else {
        header("Location: connexion.php");
    }
    ?>
</body>

</html>