<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/accueil.css">
    <title>eventBD.php</title>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $bd = "smileyFace";

        $conn = new mysqli($servername, $username, $password, $bd);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT idEvent, nom, departement, lieu, date FROM event";
        $conn->query('SET NAMES utf8');
        $result = $conn->query($sql);
    ?>
    <div class="container-fluid h-100">   
        <div class="row navBar">
            <div class="col-2 p-0">
                <button class="buttonNav" id="butUser"><a href="userBD.php">User</a></button>
            </div>
            <div class="col-10 p-0 text-end">
                <button class="buttonNav" id="butCreate"><a href="create.php">Create</a></button>
                <button class="buttonNav" id="butSignOut"><a href="index.php">Sign Out</a></button>
            </div>
        </div>
        <div class="row mainWindow">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">idEvent</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Departement</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row["idEvent"] ?></th>
                            <td><?php echo "Nom: " . $row["nom"] ?></td>
                            <td><?php echo "Departement: " . $row["departement"] ?></td>
                            <td><?php echo "Lieu: " . $row["lieu"] ?></td>
                            <td><?php echo "Date: " . $row["date"] ?></td>
                            <td>
                                <a class="btn btn-warning" type="button">Modifier</a>
                                <a class="btn btn-danger" type="button">Supprimer</a>
                            </td>
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>