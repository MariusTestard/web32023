<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>SuperHeroForm</title>
</head>
<body>
    <?php 
        //On crée les variables du formualire vide
         $nom = $image = "";

         //On crée les variables d'erreurs vides
         $nomErreur ="";

         //Variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
         $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Si on entre, on est dans l'envoie du formulaire

            if (empty($_POST["nom"])) {
                $nomErreur ="Le nom est requis";
                $erreur = true;   
            } else {
                $name = test_input($_POST["nom"]);  
            }
            $image = test_input($_POST["image"]);

            //Insérer dans la base de données
            //Si erreurs, on réaffiche le formulaire

        } if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            echo "POST = false" . $_SERVER["REQUEST_METHOD"] != "POST"
            echo "erreur" . $erreur;
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    Nom : <input type="text" name="nom"><br>
                    Image : <input type="text" name="image"><br>
                    <input type="submit">
            </form>
    <?php
        }
        function test_input($data){
            $data = trim($data);
            $data = addslashes($data);
            $data = htmlspecialchars($data);
            //< &lt
            return $data;
        }
        ?>
    <h1>----------------------------------------------------------</h1>

    <form action="resultatsGet.php" method="GET">
        Nom du super-héros : <input type="text" name="nom"><br>
        Lien de l'image : <input type="text" name="image"><br>
        <input type="submit">
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>