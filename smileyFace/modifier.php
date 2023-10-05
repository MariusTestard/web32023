<?php
session_start();
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <title>Modifier - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if (isset($_GET['eoU'])) {
        $eoU = $_GET['eoU'];
    } elseif (isset($_POST['eoU'])) {
        $eoU = $_POST['eoU'];
    } else {
        echo "erreur";
    }
    if ($_SESSION["connexion"] == true) {
        if ($eoU == 0) {
            $nom = $departement = $lieu = $date = "";
            $errorNom = $errorDepartement = $errorLieu = $errorDate = "";
            $erreur = false;
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                require("connexionServeur.php");
                $conn = new mysqli($servername, $username, $password, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM event WHERE idEvent=$id";
                $conn->query('SET NAMES utf8');
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }
                $nom = $row["nom"];
                $departement = $row["departement"];
                $lieu = $row["lieu"];
                $date = $row["date"];
                $conn->close();
            } elseif (isset($_POST['id'])) {
                $id = $_POST['id'];
            } else {
                "erreur";
            }
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
                    $nom = $_POST['nom'];
                    $departement = $_POST['departement'];
                    $lieu = $_POST['lieu'];
                    $date = $_POST['date'];

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "UPDATE event SET nom = '$nom', departement = '$departement', date = '$date' WHERE idEvent = '$id'";
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
                                <h2 class="weight-500 mb-1">Modification d'événement</h2>
                                <p class="h4 mb-2 weight-300 ">Veuillez modifier les champs à corriger</p>
                            </div>
                            <div class="card overflow-unset mt-9 mb-1">
                                <div class="card-body">
                                    <div class="avatar-icon text-center">
                                        <img src="img/tr.jpg" height="128" width="128" alt="Avatar" class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
                                        <a href="userBD.php" id="back">&#10132;</a>
                                    </div>
                                    <div class="group">
                                        <label for="nom">Nom de l'évènement</label>
                                        <input type="text" class="input" placeholder="Nom de l'événement" name="nom" value="<?php echo $nom ?>">
                                        <span class="spanErr"><?php echo $errorNom; ?></span>
                                    </div>
                                    <div class="group">
                                        <label for="departement">Département</label>
                                        <input type="text" class="input" name="departement" value="<?php echo $departement ?>">
                                        <span class="spanErr"><?php echo $errorDepartement; ?></span>
                                    </div>
                                    <div class="group">
                                        <label for="lieu">Lieu de l'événement:</label>
                                        <input type="text" class="input" placeholder="Lieu de l'événement" name="lieu" value="<?php echo $lieu ?>">
                                        <span class="spanErr"><?php echo $errorLieu; ?></span>
                                    </div>
                                    <div class="group">
                                        <label for="date">Date et heure de l'événement:</label>
                                        <input type="datetime-local" class="input" placeholder="Date de l'événement" name="date" value="<?php echo $date ?>">
                                        <span class="spanErr"><?php echo $errorDate; ?></span>
                                    </div>
                                    <div class="group">
                                        <input type="hidden" class="form-control field left" name="id" value="<?php echo $id; ?>" readonly>
                                        <input type="hidden" class="form-control field left" name="eoU" value="<?php echo $eoU; ?>" readonly>
                                    </div>
                                    <div class="group">
                                        <button class="btn btncolor block btn-lg weight-500" type="submit">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center weight-600 text-gray">
                                <a href="help.php?id=3" class="text-gray">Besoin d'aide?</a>
                            </div>
                        </form>
                    </div>
                </section>
                <?php
            }
        } else {
            $numEmplo = $password = $prenom = $nom = $recoverEmail = "";
            $errorNumEmplo = $errorPasswd = $errorPrenom = $errorNom = $errorRecoverEmail = "";
            $erreur1 = false;
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                require("connexionServeur.php");
                $conn = new mysqli($servername, $username, $password, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM user WHERE numEmploye = $id";
                $conn->query('SET NAMES utf8');
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }
                $numEmplo = $row["numEmploye"];
                $prenom = $row["prenom"];
                $nom = $row["nom"];
                $recoverEmail = $row["recoverEmail"];
                $conn->close();
            } elseif (isset($_POST['id'])) {
                $id = $_POST['id'];
            } else {
                "erreur";
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST['numEmplo'])) {
                    $errorNumEmplo = "Numéro d'employé manquant";
                    $erreur1 = true;
                } else {
                    $numEmplo = test_input($_POST["numEmplo"]);
                }
                if (empty($_POST['prenom'])) {
                    $errorPrenom = "Prénom manquant";
                    $erreur1 = true;
                } else {
                    $prenom = test_input($_POST["prenom"]);
                }
                if (empty($_POST['nom'])) {
                    $errorNom = "Nom manquant";
                    $erreur1 = true;
                } else {
                    $nom = test_input($_POST["nom"]);
                }
                if (empty($_POST['recoverEmail'])) {
                    $errorRecoverEmail = "Email de récupération manquant";
                    $erreur1 = true;
                } else {
                    $recoverEmail = test_input($_POST["recoverEmail"]);
                }

                if ($erreur1 != true) {
                    require("connexionServeur.php");
                    $conn = new mysqli($servername, $username, $password, $bd);
                    $numEmplo = $_POST['numEmplo'];
                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $recoverEmail = $_POST['recoverEmail'];

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "UPDATE user SET numEmploye = '$numEmplo', prenom = '$prenom', nom = '$nom', recoverEmail = '$recoverEmail' WHERE numEmploye = '$id'";
                    $conn->query('SET NAMES utf8');
                    if (mysqli_query($conn, $sql)) {
                        echo "Enregistrement réussi";
                        $_SESSION['prenom'] = $prenom;
                        $_SESSION['nom'] = $nom;
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                    header("Location: userBD.php");
                    mysqli_close($conn);
                ?>
                <?php
                }
            }
            if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur1 == true) {
                ?>
                <section class="login-page flex-center-center py-5 bg-light">
                    <div class="w-100 mx-auto px-2" style="max-width: 400px">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="text-center text-gray">
                                <h2 class="weight-500 mb-1">Modification de l'usager</h2>
                                <p class="h4 mb-2 weight-300 ">Veuillez modifier les champs à corriger</p>
                            </div>
                            <div class="card overflow-unset mt-9 mb-1">
                                <div class="card-body">
                                    <div class="avatar-icon text-center">
                                        <img src="img/tr.jpg" height="128" width="128" alt="Avatar" class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
                                        <a href="userBD.php" id="back">&#10132;</a>
                                    </div>
                                    <div class="group">
                                        <label for="numEmplo">Numéro d'employé:</label>
                                        <input type="text" class="input" placeholder="Numéro d'employé" name="numEmplo" value="<?php echo $numEmplo ?>">
                                        <span class="spanErr"><?php echo $errorNumEmplo; ?></span>
                                    </div>
                                    <div class="group">
                                        <label for="prenom">Prénom de l'employé:</label>
                                        <input type="text" class="input" placeholder="Prénom de l'employé" name="prenom" value="<?php echo $prenom ?>">
                                        <span class="spanErr"><?php echo $errorPrenom; ?></span>
                                    </div>
                                    <div class="group">
                                        <label for="nom">Nom de l'employé:</label>
                                        <input type="text" class="input" placeholder="Nom de l'employé" name="nom" value="<?php echo $nom ?>">
                                        <span class="spanErr"><?php echo $errorNom; ?></span>
                                    </div>
                                    <div class="group">
                                        <label for="recoverEmail">Email de récupération:</label>
                                        <input type="email" class="input" placeholder="Email de récupération" name="recoverEmail" value="<?php echo $recoverEmail ?>">
                                        <span class="spanErr"><?php echo $errorRecoverEmail; ?></span>
                                    </div>
                                    <div class="group">
                                        <input type="hidden" class="form-control field left" name="id" value="<?php echo $id; ?>" readonly>
                                        <input type="hidden" class="form-control field left" name="eoU" value="<?php echo $eoU; ?>" readonly>
                                    </div>

                                    <div class="group">
                                        <button class="btn btncolor block btn-lg weight-500" type="submit">Modifier</button>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center weight-600 text-gray">
                                <a href="help.php?id=4" class="text-gray">Besoin d'aide?</a>
                            </div>
                        </form>
                    </div>
                </section>
    <?php
            }
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
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/js/butterCake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>