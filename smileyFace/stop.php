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
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $bd = "smileyFace";

    $conn = new mysqli($servername, $username, $password, $bd);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT Etat FROM event WHERE idEvent = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["Etat"] == true) {
                $sql = "UPDATE event SET Etat = '0' WHERE idEvent = '$id'";
                mysqli_query($conn, $sql);
            } 
        }
    }
    header("Location: eventBD.php"); 
    $conn->close(); 
    }
} else {
    header("Location: connexion.php");
}














    /*
    $id = $_GET['id'];
    if ($_SESSION['idEvent'] != $id) {
        $_SESSION['eventLiveError'] = "Cet évènement n'est pas en fonction";
    } else {
        $_SESSION['eventLiveError'] = "";
        $_SESSION['eventLive'] = "Aucun";
    }
    header("Location: eventBD.php");
    */
    ?>
</body>

</html>