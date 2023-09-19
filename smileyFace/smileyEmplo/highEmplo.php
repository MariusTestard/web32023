<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>highEmplo.php</title>
</head>
<body>
    <?php
    // 1
    $id = $_SESSION['idEvent'];
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $bd = "smileyFace";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    
    $sql = "UPDATE satisfaction SET highEmplo = '(highEmplo + 1)' WHERE idSatisfaction = '$id'";





    $conn->query('SET NAMES utf8');
    if (mysqli_query($conn, $sql)) {
        echo "Enregistrement réussi";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location: index.php");
    mysqli_close($conn);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>