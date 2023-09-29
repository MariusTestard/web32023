<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/accueil.css">
    <title>Focus - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $bd = "smileyFace";

        $conn = new mysqli($servername, $username, $password, $bd);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT idEvent, nom, departement, lieu, date FROM event WHERE idEvent=$id";
        $sqlSatis = "SELECT idSatisfaction, highEtu, midEtu, lowEtu, highEmplo, midEmplo, lowEmplo FROM satisfaction WHERE idSatisfaction=$id";
        $conn->query('SET NAMES utf8');
        $result = $conn->query($sql);
        $resultSatis = $conn->query($sqlSatis);
    ?>
        <div class="container-fluid">
            <div class="row navBar">
                <div class="col-4 p-0 col-fitNav">
                    <!-- <button class="btn buttonNav" id="butUser" onclick="window.location.href='userBD.php'">Utilisateur</button> -->
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink">
                            <?php
                            $page_name = 'Évènements';
                            echo $page_name;
                            ?>
                        </a>
                        <div class="dropdown-content">
                            <button class="dropdown-item" onclick="window.location.href='userBD.php'">Utilisateurs</button>
                            <button class="dropdown-item" onclick="window.location.href='index1.php'">Vote Étudiant</button>
                            <button class="dropdown-item" onclick="window.location.href='index.php'">Vote Employeur</button>
                        </div>
                    </div>

                </div>
                <div class="col-4 text-center">
                    <div>
                        <h6>Table des événements</h6>
                    </div>
                    <h4 id="eventErrorMessage"><?php echo $_SESSION['eventLiveError']; ?></h4>
                </div>
                <div class="col-4 p-0 text-end col-fitNav">
                    <button class="btn buttonNav" id="butSignOut" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
                </div>
            </div>
            <div id="current">
                <h5>Connecté en tant que: <?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?> </h5>
                <h5>Évènement en cours: <?php echo $_SESSION['eventLive']; ?> </h5>
            </div>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($rowSatis = $resultSatis->fetch_assoc()) {
            ?>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Nom: <?php echo $row["nom"] ?></h5>
                                <p class="card-text">Departement: <?php echo $row["departement"] ?></p>
                                <p class="card-text">Lieu: <?php echo $row["lieu"] ?></p>
                                <p class="card-text">Date et heure: <?php echo $row["date"] ?></p>
                                <p class="card-text">Étudiant:
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
                                </p>
                                <p class="card-text">Employé:
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
                                </p>
                                <a href="eventBD.php" class="btn btn-primary">Revenir</a>
                            </div>
                        </div>
        </div>
<?php
                    }
                }
            } else {
                echo "Aucun résultats";
            }
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            "erreur";
        }
        $conn->close();
    } else {
        header("Location: connexion.php");
    }
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>