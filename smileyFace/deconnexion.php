<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
        session_unset();
        session_destroy();
        $_SESSION["test1"]=true;
        header("Location: connexion.php");
    ?>
</body>

</html>