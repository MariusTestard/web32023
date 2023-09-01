<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv = "refresh" content = "0; url = http://localhost/web32023/PhpBD/index.php"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>supprimer.php</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $bd = "jeuxvideo";
    
        //  Create connection
        $conn = new mysqli($servername, $username, $password, $bd);
    
        //  Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM jeuxvideo WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted succesfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>