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
    <link rel="stylesheet" href="css/index.css">
    <title>ajouter.php</title>
</head>

<body>
    <?php
    //On crée les variables du formulaire vide
    $nomJeu = $type = $dateSortie = $url = "";

    //On crée les variables d'erreurs vides
    $erreurNom = $erreurType = $erreurDate = $erreurURL = "";

    //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Si on entre, on est dans l'envoie du formulaire 
        if (empty($_POST['nomJeu'])) {
            $erreurNom = "Le nom du jeu est requis ↑";
            $erreur = true;
        } else {
            $nomJeu = test_input($_POST["nomJeu"]);
        }
        if (empty($_POST['type'])) {
            $erreurType = "Le type est requis ↑";
            $erreur = true;
        } else {
            $MDP = test_input($_POST['type']);
        }
        if (empty($_POST['dateSortie'])) {
            $erreurDate = "La date est requise ↑";
            $erreur = true;
        } else {
            $dateSortie = test_input($_POST['dateSortie']);
        }
        if (empty($_POST['url'])) {
            $erreurURL = "Le lien de l'image est requis ↑";
            $erreur = true;
        } else {
            $imgAvatar = test_input($_POST['url']);
        }

        // Inserer dans la base de données
        if ($erreur != true) {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $bd = "phpbd";

            //  Create connection
            $conn = new mysqli($servername, $username, $password, $bd);

            //  Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO jeuxvideo (id, nom, type, dateSortie, url)
            VALUES (NULL" . ",'" . $_POST['nomJeu'] . "','" . $_POST['type'] . "','" . $_POST['dateSortie'] . "','" . $_POST['url'] . "')";
            $conn->query('SET NAMES utf8');
            if (mysqli_query($conn, $sql)) {
                echo "Enregistrement réussi";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            header("Location: index.php");
            mysqli_close($conn);         
    ?>

        <?php
        }
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        ?>
        <div class="container-fluid h-100">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="nomUsager">Nom jeu</label>
                    <input type="text" class="form-control" placeholder="Nom jeu" name="nomJeu">
                    <span><?php echo $erreurNom; ?></span>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" placeholder="Type" name="type">
                    <span><?php echo $erreurType; ?></span>
                </div>
                <div class="form-group">
                    <label for="dateSortie">Date de sortie</label>
                    <input type="date" class="form-control" placeholder="Date de sortie" name="dateSortie">
                    <span><?php echo $erreurDate; ?></span>
                </div>
                <div class="form-group">
                    <label for="url">Lien vers une url</label>
                    <input type="url" class="form-control" placeholder="Lien vers une url" name="url">
                    <span><?php echo $erreurURL; ?></span>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                <a href="index.php" class="btn btn-primary" role="button">Revenir</a>
            </form>
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
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>