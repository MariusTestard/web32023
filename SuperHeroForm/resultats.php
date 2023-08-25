<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Résultat POST</title>
</head>
<body>
    <?php
        //Regarde si on arrive d'un submit du formulaire
        if($_SERVER['REQUEST_METHOD'] == "POST"){
    ?>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo $_POST['image']; ?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?php echo $_POST['nom']; ?></h5>
    </div>
    </div>
    <?php
        }
        //L'utilisateur tente d'accéder à la page sans envoyer le formulaire
        else {
            echo "Vous n'avez pas le droit d'accéder à cette page directement !";
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>