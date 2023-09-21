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

    // ----------------------------------------------- EMPÊCHER L'ASSIGNATION DE $_SESSION['idEvent'] SI UN ÉVÈNEMENT EST DÉJA EN COURS ---------------------------------------------------
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
    $sql = "SELECT nom, departement FROM event WHERE idEvent = '$id'";
    $conn->query('SET NAMES utf8');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom = $row["nom"];
        $departement = $row["departement"];
        $_SESSION['eventLive'] = $nom . " (Département " . $departement . ")";
    } else {
        $_SESSION['eventLive'] = "Aucun";
    }
    $conn->close();
    header("Location: eventBD.php");
    ?>
</body>

</html>