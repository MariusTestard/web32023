<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>index.php</title>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $bd = "phpbd";

    //  Create connection
    $conn = new mysqli($servername, $username, $password, $bd);

    //  Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, nom, type, dateSortie, url FROM jeuxvideo";
    $conn->query('SET NAMES utf8');
    $result = $conn->query($sql);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $row["id"] ?></th>
                        <td><?php echo "Nom: " . $row["nom"] ?></td>
                        <td><?php echo "Type: " . $row["type"] ?></td>
                        <td><?php echo "Date de sortie: " . $row["dateSortie"] ?></td>
                        <td><img src="<?php echo $row['url'] ?>" alt="Image du jeux"></td>
                    </tr>
                </tbody>
        <?php
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        <table>
        <a href="ajouter.php" class="btn btn-primary" role="button">Ajouter</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>