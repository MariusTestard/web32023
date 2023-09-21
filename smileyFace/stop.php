<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stop.php</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
        if ($_SESSION['idEvent'] != $id) {
            $_SESSION['eventLiveError'] = "Cet évènement n'est pas en fonction";
        } else {
            $_SESSION['eventLiveError'] = "";
            $_SESSION['eventLive'] = "Aucun";
        }
        header("Location: eventBD.php");
    ?>
</body>
</html>