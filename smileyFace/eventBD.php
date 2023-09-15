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
    <title>Événements - Cégep de Trois-Rivières</title>
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
                <button class="btn buttonNav" id="butUser" onclick="window.location.href='userBD.php'">Utilisateur</button>
            </div>
            <div class="col-8 p-2 text-center">
               <p>Table des évènements</p>
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
                            <th scope="col">idEvent</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Département</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Date</th>
                            <th scope="col">Satisfaction</th>
                            <!--
                            <th scope="col">Date</th>
                            <th scope="col">Date</th>
                            <th scope="col">Date</th>
                            -->

                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                <?php
                // IL FAUT RAJOUTER DES CHAMPS DANS LE TABLEAU POUR CONCATÉNER LA TABLE "SATISFACTION" ----------------------------------------------------
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row["idEvent"] ?></th>
                            <td><?php echo $row["nom"] ?></td>
                            <td><?php echo $row["departement"] ?></td>
                            <td><?php echo $row["lieu"] ?></td>
                            <td><?php echo $row["date"] ?></td>
                            <td></td>
                            <td>
                                <a href="modifier.php?id=<?php echo $row["idEvent"] ?>" class="btn" type="button" id="butLaunch" title="Lancer">&#128640;</a>
                                <a href="modifier.php?id=<?php echo $row["idEvent"] ?>" class="btn" type="button" id="butStop" title="Arrêter">&#128721;</a>
                                <a href="modifier.php?id=<?php echo $row["idEvent"] ?>" class="btn btn-warning" type="button" id="butModify" title="Modifier">&#128221;</a>
                                <a href="supprimer.php?id=<?php echo $row["idEvent"] ?>&eoU=<?php echo 0?>" class="btn btn-danger" type="button" id="butRemove" title="Supprimer">&#10060;</a>
                                
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
                <table>
                <a href="ajouter.php" class="btn btn-primary" role="button" id="butAjouter">Ajouter</a>
            </div>
        </div>
    </div>

    <?php
    function calc($high,$mid,$low){
        $moyennehigh = $high*100;
        $moyennemid = $mid*50;
        $moyennelow = $low*0;
        $moyenne=($moyennehigh + $moyennemid + $moyennelow)/($high + $mid + $low);
        return $moyenne;
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>