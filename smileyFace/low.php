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
    <title>lowEmplo.php</title>
</head>
<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        $eoU = $_GET['eoU'];
        require("connexionServeur.php");
        $conn = new mysqli($servername, $username, $password, $bd);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT idEvent, etat FROM event";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
               if ($row["etat"] == true) {
                   $id = $row['idEvent'];
                   mysqli_query($conn, $sql);
                   break;
               } 
           }
       }
        
        
        if ($eoU == 0) {
            $sql = "UPDATE satisfaction SET midEmplo = (midEmplo + 1) WHERE idSatisfaction = '$id'";
        } else {
            $sql = "UPDATE satisfaction SET midEtu = (midEtu + 1) WHERE idSatisfaction = '$id'";
        }
        $conn->query('SET NAMES utf8');
        if (mysqli_query($conn, $sql)) {
            echo "Enregistrement réussi";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } 
        mysqli_close($conn);

        if ($eoU == 0) {
            header("Location: index.php");
        } else {
            header("Location: index1.php"); 
        }
    } else {
        header("Location: connexion.php");
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>