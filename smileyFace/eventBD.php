<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/accueil.css">
    <title>Événements - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        //require("connexionServeur.php");
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $bd = "smileyFace";
        $conn = new mysqli($servername, $username, $password, $bd);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sqlEvent = "SELECT idEvent, nom, departement, Etat FROM event";
            $sql = "SELECT idEvent, nom, departement, lieu, date FROM event";
            $sqlSatis = "SELECT idSatisfaction, highEtu, midEtu, lowEtu, highEmplo, midEmplo, lowEmplo FROM satisfaction";
            $conn->query('SET NAMES utf8');
            $result = $conn->query($sql);
            $resultSatis = $conn->query($sqlSatis);
            $resultEvent = $conn->query($sqlEvent);
            if ($resultEvent->num_rows > 0) {
                while ($rowEvent = $resultEvent->fetch_assoc()) {
                    if ($rowEvent["Etat"] == true) {
                        $idEventCours = $rowEvent["idEvent"];
                        $idCours = $rowEvent["nom"] . " (Département " . $rowEvent["departement"] . ")";
                        $idEtatCours = $rowEvent["Etat"];
                        break;
                    } else {
                        $idCours = "Aucun";
                    }
                }
            }
        }
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
                            < <li><a href="userBD.php">Connecté en tant que: <?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?> </a></li>
                                <li><a href="userBD.php">Événement en cours: <?php echo $idCours; ?></a></li>

                                <li><a href="userBD.php">Utilisateurs</a></li>
                                <li><a href="eventBD.php">Évènements</a></li>
                                <li>
                                    <button class="btn btn-default btn-outline btn-circle collapsed" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div>
            <div class="row">
                <div class="col-11Right">
                    <a href="ajouter.php" class="btnForAdd"><b>+ </b>Ajouter</a>
                </div>
            </div>
            <div class="row">
                <table class="col-11">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Département</th>
                            <th>Lieu</th>
                            <th>Date</th>
                            <th>Étudiant</th>
                            <th>Employé</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($rowSatis = $resultSatis->fetch_assoc()) {
                    ?>
                                <tr>
                                    <td class="tdLink">

                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["nom"] ?></a>

                                    </td>
                                    <td>

                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["departement"] ?></a>

                                    </td>
                                    <td>

                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["lieu"] ?></a>

                                    </td>
                                    <td>

                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["date"] ?></a>

                                    </td>
                                    <td>
                                        <div class="rowSmile">
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "highEtu" => "smiley_smidoeuf.png"
                                            
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                
                                                echo $rowSatis[$satisfactionKey] . " ";
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                            
                                                "midEtu" => "smiley_mid.png"
                                            
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                
                                                echo $rowSatis[$satisfactionKey] . " ";
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "lowEtu" => "smiley_bad.png",
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                
                                                echo $rowSatis[$satisfactionKey] . " ";
                                            }
                                            ?>
                                        </a>
                                        </div>
                                        <div class="rowSmile">
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "highEtu" => "smiley_smidoeuf.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';   
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "midEtu" => "smiley_mid.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';   
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "lowEtu" => "smiley_bad.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';   
                                            }
                                            ?>
                                        </a>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="rowSmile">
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "highEmplo" => "smiley_smidoeuf.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                               
                                                echo $rowSatis[$satisfactionKey] . " ";
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "midEmplo" => "smiley_mid.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                               
                                                echo $rowSatis[$satisfactionKey] . " ";
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "lowEmplo" => "smiley_bad.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                               
                                                echo $rowSatis[$satisfactionKey] . " ";
                                            }
                                            ?>
                                        </a>
                                        </div>
                                        <div class="rowSmile">
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "highEmplo" => "smiley_smidoeuf.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                       
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "midEmplo" => "smiley_mid.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                       
                                            }
                                            ?>
                                        </a>
                                        <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                            <?php
                                            $satisfactionValues = [
                                                "lowEmplo" => "smiley_bad.png"
                                            ];
                                            foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                       
                                            }
                                            ?>
                                        </a>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        STATUT
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="launch.php?id=<?php echo $row["idEvent"] ?>" class="smallButtons" type="button" id="butLaunch" title="Lancer">&#128640;</a>
                                            <a href="stop.php?id=<?php echo $row["idEvent"] ?>" class="smallButtons" type="button" id="butStop" title="Arrêter">&#128721;</a>
                                        </div>
                                        <div class="row">
                                            <a href="modifier.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0 ?>" class="smallButtons" type="button" id="butModify" title="Modifier">&#128221;</a>
                                            <a href="supprimer.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0 ?>" class="smallButtons" type="button" id="butRemove" title="Supprimer">&#10060;</a>
                                        </div>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "Aucun résultats";
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
        </div>
    <?php
    } else {
        header("Location: connexion.php");
    }
    function calc($high, $mid, $low)
    {
        $moyennehigh = $high * 100;
        $moyennemid = $mid * 50;
        $moyennelow = $low * 0;
        $moyenne = ($moyennehigh + $moyennemid + $moyennelow) / ($high + $mid + $low);
        return $moyenne;
    }
    ?>
    <script type="text/javascript"></script>
</body>

</html>