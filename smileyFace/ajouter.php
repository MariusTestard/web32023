<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Ajouter d'évènement - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        $nom = $departement = $lieu = $date = "";
        $errorNom = $errorDepartement = $errorLieu = $errorDate = "";
        $erreur = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['nom'])) {
                $errorNom = "Nom manquant";
                $erreur = true;
            } else {
                $nom = test_input($_POST["nom"]);
            }
            if (empty($_POST['departement'])) {
                $errorDepartement = "Departement manquant";
                $erreur = true;
            } else {
                $departement = test_input($_POST["departement"]);
            }
            if (empty($_POST['lieu'])) {
                $errorLieu = "Lieu manquant";
                $erreur = true;
            } else {
                $lieu = test_input($_POST["lieu"]);
            }
            if (empty($_POST['date'])) {
                $errorDate = "Date manquante";
                $erreur = true;
            } else {
                $date = test_input($_POST["date"]);
            }
            if ($erreur != true) {
                $nom = $_POST['nom'];
                $departement = $_POST['departement'];
                $lieu = $_POST['lieu'];
                $date = $_POST['date'];
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $bd = "smileyFace";
                $conn = new mysqli($servername, $username, $password, $bd);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "INSERT INTO event (idEvent, nom, departement, lieu, date)
            VALUES (NULL" . ",'" . $_POST['nom'] . "','" . $_POST['departement'] . "','" . $_POST['lieu'] . "','" . $_POST['date'] . "')";

                $conn->query('SET NAMES utf8');
                if (mysqli_query($conn, $sql)) {
                    echo "Enregistrement réussi";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                $sql = "INSERT INTO satisfaction (idSatisfaction, highEtu, midEtu, lowEtu, highEmplo, midEmplo, lowEmplo)
                VALUES(NULL, 0, 0, 0, 0, 0, 0)";
                $conn->query('SET NAMES utf8');
                if (mysqli_query($conn, $sql)) {
                    echo "Enregistrement réussi";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                header("Location: eventBD.php");
                mysqli_close($conn);
    ?>
            <?php
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            ?>
            <div class="container-fluid h-100 d-flex flex-column">
                <div class="row top-left test1">
                    <div class="col-1 p-0 m-0">
                        <button type="button" class="btn" id="butBack" onclick="window.location.href='eventBD.php'">Revenir</button>
                    </div>
                </div>
                <div class="row middle test99 flex-grow-1 d-flex">
                    <div class="col-2 my-form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <h3>Création d'un évènement</h3>
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom de l'évènement</label>
                                <input type="text" class="form-control" placeholder="Nom de l'évènement" name="nom">
                                <span><?php echo $errorNom; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="departement">Departement</label>
                                <input type="text" class="form-control" placeholder="Departement" name="departement">
                                <span><?php echo $errorDepartement; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="lieu">Lieu</label>
                                <input type="text" class="form-control" placeholder="Lieu" name="lieu">
                                <span><?php echo $errorLieu; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="nom">Date et heure</label>
                                <input type="datetime-local" class="form-control" placeholder="Date" name="date">
                                <span><?php echo $errorDate; ?></span>
                            </div>
                            <div class="middle">
                                <button type="submit" class="btn btn-success mt-2 maxlargeur">Créer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php
        }
        function test_input($data)
        {
            $data = trim($data);
            $data = addslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    } else {
        header("Location: connexion.php");
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>