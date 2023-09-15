<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="css/accueil.css">
    <title>Utilisateurs - Cégep de Trois-Rivières</title>
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

        $sql = "SELECT numEmploye, password, prenom, nom, recoverEmail FROM user";
        $conn->query('SET NAMES utf8');
        $result = $conn->query($sql);
    ?>
    <div class="container-fluid h-100">   
        <div class="row navBar">
            <div class="col-2 p-0">
                <button class="btn buttonNav" id="butUser" onclick="window.location.href='eventBD.php'">Événement</button>
            </div>
            <div class="col-8 p-2 text-center">
               <p>Table des utilisateurs</p>
            </div>
            <div class="col-2 p-0 text-end">
                
                <button class="btn buttonNav" id="butSignOut" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
            </div>
        </div>
        <div class="row mainWindow">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N° Employé</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email de récupération</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row["numEmploye"] ?></th>
                            <td><?php echo $row["prenom"] ?></td>
                            <td><?php echo $row["nom"] ?></td>
                            <td><?php echo $row["recoverEmail"] ?></td>
                            <td>
                                <a href="supprimer.php?id=<?php echo $row["numEmploye"] ?>&eoU=<?php echo 1?>" class="btn btn-danger" type="button" id="butRemove">&#10060;</a>
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
                <button class="btn buttonNav" id="butCreate" onclick="window.location.href='create.php'">Création</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>