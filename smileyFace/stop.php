<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stop.php</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        $id = $_GET['id'];
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            require("connexionServeur.php");
            $conn = new mysqli($servername, $username, $password, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT idEvent ,etat FROM event WHERE idEvent = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["etat"] == 1) {
                    $_SESSION['pasEnCours'] = "";
                    $_SESSION['enCours'] = "";
                    $sql = "UPDATE event SET etat = '0' WHERE idEvent = '$id'";
                    if (mysqli_query($conn, $sql)) {
                        $conn->close();
                        header("Location: eventBD.php");
                    }
                } else {
                    $_SESSION['pasEnCours'] = "Cet évènement n'est pas en cours !";
                    $_SESSION['enCours'] = "";
                    header("Location: eventBD.php");
                }
            } else {
                $_SESSION['enCours'] = "";
            }
        }
        header("Location: eventBD.php");
    } else {
        header("Location: connexion.php");
    }
    ?>
</body>

</html>