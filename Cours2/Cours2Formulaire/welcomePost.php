<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de traitement</title>
</head>
<body>

    <?php
        //Regarde si on arrive d'un submit du formulaire
        if($_SERVER['REQUEST_METHOD'] == "POST"){
    ?>
    <h1>
        <?php echo $_POST['name'];?>
    </h1>

    <h2>
        <?php echo $_POST['email'];?>
    </h2>

    <?php
        }
        //L'utilisateur tente d'accéder à la page sans envoyer le formulaire
        else {
            echo "Vous n'avez pas le droit d'accéder à cette page directement !";
        }
    ?>
    
</body>
</html>