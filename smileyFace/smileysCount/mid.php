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
    <title>midEmplo.php</title>
</head>
<body>
    <?php
        $eoU = $_GET['eoU'];
        $id = $_SESSION['idEvent'];
        $servername = "localhost";
        $usernameBD = "root";
        $passwordBD = "root";
        $bd = "smileyFace";

        $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }if ($eoU == 0) {
            $sql = "UPDATE satisfaction SET lowEmplo = (lowEmplo + 1) WHERE idSatisfaction = '$id'";
        } else {
            $sql = "UPDATE satisfaction SET lowEtu = (lowEtu + 1) WHERE idSatisfaction = '$id'";
        }
        $conn->query('SET NAMES utf8');
        if (mysqli_query($conn, $sql)) {
            echo "Enregistrement réussi";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } if ($eoU == 0) {
            header("Location: ../index.php");
        } else {
            header("Location: ../index1.php"); 
        }
        mysqli_close($conn);
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>