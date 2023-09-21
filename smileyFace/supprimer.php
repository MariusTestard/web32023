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
    <title>Supprimer - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    $toF = false;
    $eoU = $_GET['eoU'];
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $bd = "smileyFace";
    $conn = new mysqli($servername, $username, $password, $bd);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        if ($eoU === "1") {
            $toF = true;
            $sql = "DELETE FROM user WHERE numEmploye = $id";
        } else {
            $sql = "DELETE FROM satisfaction WHERE idSatisfaction = $id";

            if ($conn->query($sql) === TRUE) {
                echo "Record deleted succesfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
            $sql = "DELETE FROM event WHERE idEvent = $id";
        }
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted succesfully";
            if ($toF === false) {
                header("Location: eventBD.php");
            } else {
                header("Location: userBD.php");
            }
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>