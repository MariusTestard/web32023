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
         $_SESSION['eventLiveError'] = 0;
         if ($_SESSION['idEvent'] == $id) {
            $_SESSION['eventLive'] = 0;
            $_SESSION['eventLiveError'] = 0;
         } else {
            $_SESSION['eventLiveError'] = 1;
         }
    ?>
</body>
</html>