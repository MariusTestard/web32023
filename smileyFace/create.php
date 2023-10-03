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
    <title>Création d'usagers - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        $numEmplo = $passwd = $recoverEmail = $prenom = $nom = "";
        $errorNumEplo = $errorPasswd = $errorRecoverEmail = $errorPrenom = $errorNom = "";
        $erreur = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['numEmplo'])) {
                $errorNumEplo = "N° employé manquant";
                $erreur = true;
            } else {
                $numEmplo = test_input($_POST["numEmplo"]);
            }
            if (empty($_POST['recoverEmail'])) {
                $errorRecoverEmail = "Email de récupération manquant";
                $erreur = true;
            } else {
                $recoverEmail = test_input($_POST["recoverEmail"]);
            }
            if (empty($_POST['prenom'])) {
                $errorPrenom = "Prénom manquant";
                $erreur = true;
            } else {
                $prenom = test_input($_POST["prenom"]);
            }
            if (empty($_POST['nom'])) {
                $errorNom = "Nom manquant";
                $erreur = true;
            } else {
                $nom = test_input($_POST["nom"]);
            }
            if ($erreur != true) {
                $numEmplo = $_POST['numEmplo'];
                $recoverEmail = $_POST['recoverEmail'];
                $passwd = $_POST['numEmplo'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                require("connexionServeur.php");
                $conn = new mysqli($servername, $username, $password, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "INSERT INTO user (numEmploye, password, prenom, nom, recoverEmail) 
                VALUES ('$numEmplo', '$passwd', '$prenom', '$nom', '$recoverEmail')";
                $conn->query('SET NAMES utf8');
                if (mysqli_query($conn, $sql)) {
                    echo "Enregistrement réussi";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                header("Location: userBD.php");
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
                            <h2 class="weight-500 mb-1">Création d'un utilisateur</h2>
                            <p class="h4 mb-2 weight-300">Veuillez entrez les informations</p>
                        </div>
                        <div class="card overflow-unset mt-9 mb-1">
                            <div class="card-body">
                                <div class="avatar-icon text-center">
                                    <img src="img/tr.jpg" height="128" width="128" alt="Avatar" class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
                                </div>
                                <div class="group">
                                    <label for="numEmplo">Numéro d'employé:</label>
                                    <input type="text" class="input" placeholder="Numéro d'employé" name="numEmplo">
                                    <span class="spanErr"><?php echo $errorNumEplo; ?></span>
                                </div>
                                <div class="group">
                                    <label for="recoverEmail">Email de récupération</label>
                                    <input type="text" class="form-control" placeholder="Email de récupération" name="recoverEmail">
                                    <span class="spanErr"><?php echo $errorRecoverEmail; ?></span>
                                </div>
                                <div class="group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom">
                                    <span class="spanErr"><?php echo $errorPrenom; ?></span>
                                </div>
                                <div class="group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom">
                                    <span class="spanErr"><?php echo $errorNom; ?></span>
                                </div>
                                <div class="group"></div>
                                <div class="group">
                                    <button class="btn btncolor block btn-lg weight-500 test" type="submit">Créer</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-center weight-600 text-gray">
                            <a href="" class="text-gray">Besoin d'aide?</a>
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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/js/butterCake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>