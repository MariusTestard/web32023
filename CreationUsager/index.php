<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>

<body>
    <?php
    //On crée les variables du formulaire vide
    $nomUsager = $MDP = $MDPconf = $adresseCour = $imgAvatar = $dateNais = $moyenTrans = "";

    //On crée les variables d'erreurs vides
    $erreurNomUsa = $erreurMDP = $erreurMDPConf = $erreurAdressCour = $erreurLienImg = $erreurSexe = $erreurDat = "";

    //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Si on entre, on est dans l'envoie du formulaire 
        if (empty($_POST['nomUsager'])) {
            $erreurNomUsa = "Le nom de l'usager est requis";
            $erreur = true;
        } elseif ($_POST['nomUsager'] == "Marius Testard") {
            $erreurNomUsa = "Le nom de l'usager est déja pris ↑";
            $erreur = true;
        } else {
            $nomUsager = test_input($_POST["nomUsager"]);
        } if (empty($_POST['MDP'])) {
            $erreurMDP = "Le mot de passe est requis ↑";
            $erreur = true;
        } else {
            $MDP = test_input($_POST["MDP"]);
        } if (empty($_POST['MDPconf'])) {
            $erreurMDPConf = "Le mot de passe de confirmation est requis ↑";
            $erreur = true;
        } elseif (strcmp($_POST["MDP"], $_POST['MDPconf']) == true) {
            $erreurMDPConf = "Les mots de passe ne sont pas identiques ↑";
            $erreur = true;
        } else {
            $MDPconf = test_input($_POST["MDPconf"]);
        } if (empty($_POST['adresseCour'])) {
            $erreurAdressCour = "L'adresse courriel est requise ↑";
            $erreur = true;
        } elseif (validateEmail($_POST['adresseCour']) == false) {
            $erreurAdressCour = "L'adresse courriel n'est pas valide ↑";   
            $erreur = true;
        } else {
            $adresseCour = test_input($_POST["adresseCour"]);
        } if (empty($_POST['imgAvatar'])) {
            $erreurLienImg = "Le lien de l'image est requis ↑";
            $erreur = true;
        } else {
            $imgAvatar = $_POST["imgAvatar"];
        } if (empty($_POST['sexe'])) {
            $erreurSexe = "Le sexe est requis ↓";
            $erreur = true;
        } else {
            $sexe = test_input($_POST["sexe"]);
        } if (empty($_POST['dateNais'])) {
            $erreurDat = "La date est requise ↑";
            $erreur = true;
        } else {
            $date = test_input($_POST["dateNais"]);
        }
        // Inserer dans la base de données
        if ($erreur != true) {
        ?>
        <div class="container-fluid h-100">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $_POST['imgAvatar']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $_POST['nomUsager']; ?></h5>
                    <p class="card-text"><?php echo $_POST['adresseCour']; ?></p>
                    <p class="card-text"><?php echo $_POST['dateNais']; ?></p>
                    <p class="card-text"><?php echo $_POST['sexe']; ?></p>
                    <p class="card-text"><?php echo $_POST['moyenTrans']; ?></p>
                    <a href="index.php" class="btn btn-primary">Créer un nouvel usager</a>
                </div>
            </div>
        </div>
        <?php  
         //SI erreurs, on réaffiche le formulaire
    }
}
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    ?>
        <div class="container-fluid h-100">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                        <label for="nomUsager">Nom usager</label>
                        <input type="text" class="form-control" placeholder="Nom usager" name="nomUsager">
                        <span><?php echo $erreurNomUsa;?></span>
                </div>
                <div class="form-group">
                        <label for="MDP">Mot de passe</label>
                        <input type="password" class="form-control" placeholder="Mot de passe" name="MDP">
                        <span><?php echo $erreurMDP;?></span>
                </div>
                <div class="form-group">
                    <label for="MDPconf">Confirmation mot de passe</label>
                    <input type="password" class="form-control" placeholder="Confirmation mot de passe" name="MDPconf">
                    <span><?php echo $erreurMDPConf;?></span>
                </div>
                <div class="form-group">
                    <label for="adresseCour">Adresse courriel</label>
                    <input type="text" class="form-control" placeholder="Adresse courriel" name="adresseCour">
                    <span><?php echo $erreurAdressCour;?></span>
                </div>    
                <div class="form-group">
                    <label for="imgAvatar">Lien vers une image avatar</label>
                    <input type="url" class="form-control" placeholder="Lien vers une image avatar" name="imgAvatar">
                    <span><?php echo $erreurLienImg;?></span>
                </div>
                <div class="form-group">
                    <label>Sexe:</label>
                    <span><?php echo $erreurSexe;?></span>
                    <br>
                    <label for="sexe">Homme</label>
                    <input type="radio" name="sexe" value="homme">
                    <br>
                    <label for="sexe">Femme</label>
                    <input type="radio" name="sexe" value="femme">
                </div>
                <div class="form-group">
                    <label for="dateNais">Date de naissance</label>
                    <input type="date" class="form-control" name="dateNais">
                    <span><?php echo $erreurDat;?></span>
                </div>
                <div class="form-group">
                    <label for="moyenTrans">Moyen de transport:</label>
                    <br>
                    <select name="moyenTrans">
                        <option value="auto">Auto</option>
                        <option value="autobus">Autobus</option>
                        <option value="marche">Marche</option>
                        <option value="velo">Vélo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
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

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
      }
        ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>