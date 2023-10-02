<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="css/accueil.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
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
        <div>
            <nav class="navbar navbar-inverse">
                <div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-4">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="https://www.cegeptr.qc.ca/" target="_blank">Cégep de Trois-Rivières</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-4">
                        <ul class="nav navbar-nav navbar-right">
                            <!--
                            <li><a href="userBD.php">Connecté en tant que: <?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?> </a></li>
                            <li><a href="userBD.php">Événement en cours: <?php echo $idCours; ?></a></li>
                            -->
                            <li><a href="userBD.php">Utilisateurs</a></li>
                            <li><a href="eventBD.php">Évènements</a></li>
                            <li>
                            <button class="btn btn-default btn-outline btn-circle collapsed" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
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
    <script type="text/javascript"></script>
</body>

</html>