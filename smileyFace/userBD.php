<?php
session_start();
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/userBD.css">
    <title>Utilisateurs - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        require("connexionServeur.php");
        $conn = new mysqli($servername, $username, $password, $bd);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT numEmploye, password, prenom, nom, recoverEmail FROM user";
            $conn->query('SET NAMES utf8');
            $result = $conn->query($sql);
            $sqlEvent = "SELECT idEvent, nom, departement, etat FROM event";
            $sqlNom = "SELECT idEvent, nom, departement, lieu, date FROM event";
            $conn->query('SET NAMES utf8');
            $resultNom = $conn->query($sqlNom);
            $resultEvent = $conn->query($sqlEvent);
            if ($resultEvent->num_rows > 0) {
                while ($rowEvent = $resultEvent->fetch_assoc()) {
                    if ($rowEvent["etat"] == true) {
                        $idEventCours = $rowEvent["idEvent"];
                        $idCours = $rowEvent["nom"] . " (Département " . $rowEvent["departement"] . ")";
                        $idEtatCours = $rowEvent["etat"];
                        break;
                    } else {
                        $idCours = "Nul";
                    }
                }
            }
        }
    ?>
        <!-- CONTAINER -->
        <div>

            <!-- NAVBAR -->
            <div class="topnav" id="myTopnav">
                <div>
                    <a href="https://www.cegeptr.qc.ca/">Cégep TR</a>
                </div>
                <div>
                    <a href="eventBD.php">Évènements</a>
                    <a href="userBD.php" class="active">Utilisateurs</a>
                </div>

                <div class="dropdown">
                    <button class="dropbtn"><?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content right-align">
                        <a href="index1.php">Vote Étudiant</a>
                        <a href="index.php">Vote Employé</a>
                        <a href="deconnexion.php">Déconnexion</a>
                    </div>
                </div>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>

            <!-- PAGE -->
            <div>
                <div class="row">
                    <div class="col-11Mid">
                        <div class="enCours">En cours: <?php echo $idCours; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11Mid">
                        <a href="create.php" class="btnForAdd"><b>+ </b>Ajouter</a>
                    </div>
                </div>
                <div class="row">
                    <table class="col-11">
                        <thead>
                            <tr>
                                <th>N° Employé</th>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>Email de récupération</th>
                                <th>Actions</th>
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
                                            <a href="modifier.php?id=<?php echo $row["numEmploye"] ?>&eoU=<?php echo 1 ?>" class="smallButtons" type="button" title="Modifier">&#128221;</a>
                                            <a href="supprimer.php?id=<?php echo $row["numEmploye"] ?>&eoU=<?php echo 1 ?>" class="smallButtons" type="button" title="Supprimer">&#10060;</a>
                                        </td>
                                    </tr>
                                </tbody>
                        <?php
                            }
                        } else {
                            echo "Aucun résultats";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </div> <!-- PAGE -->
        </div> <!-- CONTAINER -->
    <?php
    } else {
        header("Location: connexion.php");
    }
    ?>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
</body>

</html>