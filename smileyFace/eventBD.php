<?php
session_start();
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/eventBD.css">
    <title>Événements - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if (!isset($_SESSION['enCours'])) {
        $_SESSION['enCours'] = "";
    }
    if (!isset($idCours)) {
        $idCours = "Nul";
    }
    if (!isset($_SESSION['pasEnCours'])) {
        $_SESSION['pasEnCours'] = "";
    }
    if (isset($_SESSION["connexion"])) {
        if ($_SESSION["connexion"] == true) {
            require("connexionServeur.php");
            $conn = new mysqli($servername, $username, $password, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $sqlEvent = "SELECT idEvent, nom, departement, etat FROM event";
                $sql = "SELECT idEvent, nom, departement, lieu, date, etat FROM event";
                $sqlSatis = "SELECT idSatisfaction, highEtu, midEtu, lowEtu, highEmplo, midEmplo, lowEmplo FROM satisfaction";
                $conn->query('SET NAMES utf8');
                $result = $conn->query($sql);
                $resultSatis = $conn->query($sqlSatis);
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
            <div>
                <div class="topnav" id="myTopnav">
                    <div>
                        <a href="https://www.cegeptr.qc.ca/">Cégep TR</a>
                    </div>
                    <div>
                        <a href="eventBD.php" class="active">Évènements</a>
                        <a href="userBD.php">Utilisateurs</a>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"><?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?>
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="index1.php">Vote Étudiant</a>
                            <a href="index.php">Vote Employé</a>
                            <a href="deconnexion.php">Déconnexion</a>
                        </div>
                    </div>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div>
                    <?php
                    if ($_SESSION['enCours'] == "Un évènement est présentement en cours !" || $_SESSION['pasEnCours'] == "Cet évènement n'est pas en cours !") {
                    ?>
                        <div class="row" id="eventErrorMessage">
                            <div class="col-11Mid">
                                <div class="enCoursRed">
                                    <?php
                                    if ($_SESSION['enCours'] == "Un évènement est présentement en cours !") {
                                        echo $_SESSION['enCours'];
                                    }
                                    if ($_SESSION['pasEnCours'] == "Cet évènement n'est pas en cours !") {
                                        echo $_SESSION['pasEnCours'];
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-11Mid">
                            <div class="enCours">En cours: <?php echo $idCours; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11Mid">
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
                                                            echo '<img class="littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        }
                                                        ?>
                                                    </a>
                                                    <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                        <?php
                                                        $satisfactionValues = [
                                                            "midEtu" => "smiley_mid.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        }
                                                        ?>
                                                    </a>
                                                    <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                        <?php
                                                        $satisfactionValues = [
                                                            "lowEtu" => "smiley_bad.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
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
                                                            echo '<img class="littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        }
                                                        ?>
                                                    </a>
                                                    <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                        <?php
                                                        $satisfactionValues = [
                                                            "midEmplo" => "smiley_mid.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        }
                                                        ?>
                                                    </a>
                                                    <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                        <?php
                                                        $satisfactionValues = [
                                                            "lowEmplo" => "smiley_bad.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['etat'] == 1) {
                                                ?>
                                                    <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                        <div class="statusIconA">Actif</div>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                        <div class="statusIconI">Inactif</div>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="rowActions">
                                                    <a href="launch.php?id=<?php echo $row["idEvent"] ?>" class="smallButtons" type="button" id="butLaunch" title="Lancer">&#128640;</a>
                                                    <a href="stop.php?id=<?php echo $row["idEvent"] ?>" class="smallButtons" type="button" id="butStop" title="Arrêter">&#128721;</a>
                                                    <a href="modifier.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0 ?>" class="smallButtons" type="button" id="butModify" title="Modifier">&#128221;</a>
                                                    <a href="supprimer.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0 ?>" class="smallButtons" type="button" id="butRemove" title="Supprimer">&#10060;</a>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            } else {
                                
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
        <?php
        if ($_SESSION['enCours'] == "Un évènement est présentement en cours !" || $_SESSION['pasEnCours'] == "Cet évènement n'est pas en cours !") {
        ?>
            <script>
                setTimeout(function() {
                    var errorElement = document.getElementById('eventErrorMessage');
                    errorElement.style.animation = "fadeinout 1.75s";
                    setTimeout(function() {
                        errorElement.style.display = "none";
                    }, 1750);
                }, 1750);
            </script>
        <?php
        }
        ?>
        <script type="text/javascript"></script>
</body>

</html>