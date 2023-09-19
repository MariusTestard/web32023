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
    $id = $_GET['id'];
    $_SESSION['idEvent'] = $id;

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $bd = "smileyFace";

    $conn = new mysqli($servername, $username, $password, $bd);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT nom, departement FROM event";
    $conn->query('SET NAMES utf8');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    $nom = $row["nom"];
    $departement = $row["departement"];


    $_SESSION['eventLive'] = $nom . " pour " . $departement;

    $conn->close();

    ?>
</body>
</html>