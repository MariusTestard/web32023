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
    <link rel="stylesheet" href="js/script.js">
    <title>Utilisateurs - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
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
        <div class="container-fluid h-100" id="backgroundimage">
            <div class="row navBar">
                <div class="col-4 p-0 col-fitNav">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink">
                            <?php
                            $page_name = 'Utilisateurs';
                            echo $page_name;
                            ?>
                        </a>
                        <div class="dropdown-content">
                            <button class="dropdown-item" onclick="window.location.href='eventBD.php'">Événements</button>
                            <button class="dropdown-item" onclick="window.location.href='index.php'">Vote Étudiant</button>
                            <button class="dropdown-item" onclick="window.location.href='index1.php'">Vote Employeur</button>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-center col-mainTitle">
                    <div id="mainTitle">
                        <h6 id="test1234">Table des utilisateurs</h6>
                    </div>
                </div>
                <div class="col-4 p-0 text-end col-fitNav">
                    <button class="btn buttonNav" id="butSignOut" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
                </div>
            </div>
            <div id="current">
                <h5>Connecté en tant que: <?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?> </h5>
                <h5>Évènement en cours: <?php ?> </h5>
            </div>
            <div class="row mainWindow">
                <div class="col-12 my-custom-scrollbar">
                    <table class="table table table-hover table-bordered">
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
                                            <a href="supprimer.php?id=<?php echo $row["numEmploye"] ?>&eoU=<?php echo 1 ?>" class="btn btn-danger" type="button" id="butRemove" title="Supprimer">&#10060;</a>
                                            <a href="modifier.php?id=<?php echo $row["numEmploye"] ?>&eoU=<?php echo 1 ?>" class="btn btn-warning" type="button" id="butModify" title="Modifier">&#128221;</a>
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
                    </table>
                    <button class="btn buttonNav" id="butCreate" onclick="window.location.href='create.php'">Création</button>
                </div>
            </div>
        </div>
    <?php

    } else {
        header("Location: connexion.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>