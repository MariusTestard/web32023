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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/css/butterCake.min.css">
    <link rel="stylesheet" href="css/connexion.css">
    <script src="js/connexion.js"></script>
    <title>Ajout d'évènements - Cégep de Trois-Rivières</title>
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
                require("connexionServeur.php");
                $conn = new mysqli($servername, $username, $password, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "INSERT INTO event (idEvent, nom, departement, lieu, date)
                VALUES (NULL" . ",'" . $nom . "','" . $departement . "','" . $lieu . "','" . $date . "')";
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
            <section class="login-page flex-center-center py-5 bg-light">
                <div class="w-100 mx-auto px-2" style="max-width: 400px">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="text-center text-gray">
                            <h2 class="weight-500 mb-1">Création d'un évènement</h2>
                            <p class="h4 mb-2 weight-300">Veuillez entrer les informations</p>
                        </div>
                        <div class="card overflow-unset mt-9 mb-1">
                            <div class="card-body">
                                <div class="avatar-icon text-center">
                                    <img src="img/tr.jpg" height="128" width="128" alt="Avatar" class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
                                    <a href="eventBD.php" id="back">&#10132;</a>
                                </div>
                                <div class="group">
                                    <label for="nom">Nom de l'évènement</label>
                                    <input type="text" class="form-control" placeholder="Nom de l'évènement" name="nom">
                                    <span class="spanErr"><?php echo $errorNom; ?></span>
                                </div>
                                <div class="group">
                                    <label for="departement">Departement</label>
                                    <input type="text" class="form-control" placeholder="Departement" name="departement">
                                    <span class="spanErr"><?php echo $errorDepartement; ?></span>
                                </div>
                                <div class="group">
                                    <label for="lieu">Lieu</label>
                                    <input type="text" class="form-control" placeholder="Lieu" name="lieu">
                                    <span class="spanErr"><?php echo $errorLieu; ?></span>
                                </div>
                                <div class="group">
                                    <label for="nom">Date et heure</label>
                                    <input type="datetime-local" class="form-control" placeholder="Date" name="date">
                                    <span class="spanErr"><?php echo $errorDate; ?></span>
                                </div>
                                <div class="group"></div>
                                <div class="group">
                                    <button class="btn btncolor block btn-lg weight-500 test" type="submit">Ajouter</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-center weight-600 text-gray">
                            <a href="help.php?id=2" class="text-gray">Besoin d'aide?</a>
                        </div>
                    </form>
                </div>
            </section>
    <?php
        }
    } else {
        header("Location: connexion.php");
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
</body>

</html>