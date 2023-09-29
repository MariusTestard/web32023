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
    <script src="js/script.js"></script>
    <title>Événements - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
    if ($_SESSION['EventFirstCo']) {
        $_SESSION['eventLiveError'] = "";
        $_SESSION['eventLive'] = "Aucun"; //À pense a qqc de meilleur
        $_SESSION['EventFirstCo'] = false;
    }
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $bd = "smileyFace";

    $conn = new mysqli($servername, $username, $password, $bd);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // REGARDER DANS TOUT LE TABLEAU POUR VOIR SI UN ÉVÈNEMENT EST ACTIF (ETAT), SI OUI ON VA GET L'IDEVENT DE L'ÉVÈNEMENT,
        // ON VA FAIRE UNE AUTRE QUERY POUR ALLER CHERCHER LE NOM ET LE DEPARTMENT DE CELUI-CI ET METTRE LE RÉSULTAT DANS UNE 
        // VARIABLE, SINON ASSIGNER "AUCUN" DANS LA VARIABLE

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
    <div class="container-fluid h-100" id="backgroundimage">
        <div class="row navBar">
            <div class="col-4 p-0 col-fitNav">
                <!-- <button class="btn buttonNav" id="butUser" onclick="window.location.href='userBD.php'">Utilisateur</button> -->
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink">
                        <?php
                        $page_name = 'Événements';
                        echo $page_name;
                        ?>
                    </a>
                    <div class="dropdown-content">
                        <button class="dropdown-item" onclick="window.location.href='userBD.php'">Utilisateurs</button>
                        <button class="dropdown-item" onclick="window.location.href='index1.php'">Vote Étudiant</button>
                        <button class="dropdown-item" onclick="window.location.href='index.php'">Vote Employeur</button>
                    </div>
                </div>
                <div>Connecté en tant que: <?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?> </div>
            </div>
            <div class="col-4 text-center">
                <div>
                    <h6>Table des événements</h6>
                </div>
                <h4 id="eventErrorMessage"><?php echo $_SESSION['eventLiveError']; ?></h4>
            </div>
            <div class="col-4 p-0 text-end col-fitNav">
                <button class="btn buttonNav" id="butSignOut" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
                <div>Événement en cours: <?php echo $idCours; ?> </div>
            </div>
        </div>
        <div class="row mainWindow">
            <div class="col-10">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Département
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="departementDropdown" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="departementDropdown">
                                        <!--
                                        <li><a class="dropdown-item" onclick="updateTable()">Ascending</a></li>
                                        <li><a class="dropdown-item" onclick="updateTable()">Descending</a></li>
                                        -->
                                    </ul>
                                </div>
                            </th>
                            <th scope="col">Lieu</th>
                            <th scope="col" onclick="sortTableByDate()">Date et heure</th>
                            <th scope="col">Étudiant</th>
                            <th scope="col">Employé</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($rowSatis = $resultSatis->fetch_assoc()) {
                    ?>
                                <tbody>
                                    <tr>

                                        <td class="tdLink">
                                            <div class="divBox">
                                                <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["nom"] ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divBox">
                                                <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["departement"] ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divBox">
                                                <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["lieu"] ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divBox">
                                                <a href="zoom.php?id=<?php echo $row["idEvent"] ?>"><?php echo $row["date"] ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divBox">
                                                <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                    <?php
                                                    $satisfactionValues = [
                                                        "highEtu" => "smiley_smidoeuf.png",
                                                        "midEtu" => "smiley_mid.png",
                                                        "lowEtu" => "smiley_bad.png",
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </a>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="divBox">
                                                <a href="zoom.php?id=<?php echo $row["idEvent"] ?>">
                                                    <?php
                                                    $satisfactionValues = [
                                                        "highEmplo" => "smiley_smidoeuf.png",
                                                        "midEmplo" => "smiley_mid.png",
                                                        "lowEmplo" => "smiley_bad.png",
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </a>
                                            </div>

                                        </td>
                                        <td>
                                            <a href="launch.php?id=<?php echo $row["idEvent"] ?>" class="btn" type="button" id="butLaunch" title="Lancer">&#128640;</a>
                                            <a href="stop.php?id=<?php echo $row["idEvent"] ?>" class="btn" type="button" id="butStop" title="Arrêter">&#128721;</a>
                                            <a href="reset.php?id=<?php echo $row["idEvent"] ?>" class="btn" type="button" id="butStop" title="Réinitialiser">&#128260;</a>
                                            <a href="modifier.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0 ?>" class="btn btn-warning" type="button" id="butModify" title="Modifier">&#128221;</a>
                                            <a href="supprimer.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0 ?>" class="btn btn-danger" type="button" id="butRemove" title="Supprimer">&#10060;</a>
                                        </td>
                                    </tr>
                                </tbody>
                    <?php
                            }
                        }
                    } else {
                        echo "Aucun résultats";
                    }
                    $conn->close();
                    ?>
                </table>
                <a href="ajouter.php" class="btn btn-primary" role="button" id="butAjouter">Ajouter</a>
            </div>
        </div>
    </div>
    <?php
    function calc($high, $mid, $low)
    {
        $moyennehigh = $high * 100;
        $moyennemid = $mid * 50;
        $moyennelow = $low * 0;
        $moyenne = ($moyennehigh + $moyennemid + $moyennelow) / ($high + $mid + $low);
        return $moyenne;
    }
} else {
    header("Location: connexion.php");
}
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>