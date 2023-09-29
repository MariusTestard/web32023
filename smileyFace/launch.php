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
// ----------------------------------------------- EN TOUT PREMIER LIEU, ON DOIT REGARDER SI UN ÉVÈNEMENT A LE "STATE" ACTIF. SI C'EST LE CAS, PETIT MESSAGE SIGNIFICATIF, SINON CHANGER L'ÉTAT DU BON ÉVÈNEMENT A "true" ---------------------------------------------------
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
        $sql = "SELECT Etat FROM event";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["Etat"] == true) {
                    echo "Un évènement est présentement en cours !";
                    $bool = true;
                    break;
                } 
            }
            if ($bool == false) {
                $sql = "UPDATE event SET Etat = '1' WHERE idEvent = '$id'";
                mysqli_query($conn, $sql);
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
    $_SESSION['idEvent'] = $id;


    if($_SESSION['eventIdLive']!=$_SESSION['idEvent']) {
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
        $_SESSION['eventIdLive']= $row["id"];
        $nom = $row["nom"];
        $departement = $row["departement"];
        $_SESSION['eventLive'] = $nom . " (Département " . $departement . ")";
    } else {
        $_SESSION['eventLive'] = "Aucun";
    }
    $conn->close();
    header("Location: eventBD.php"); 
    }

    header("Location: eventBD.php"); 
    */
    
    ?>
</body>

</html>