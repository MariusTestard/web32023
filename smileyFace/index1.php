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
    <link rel="stylesheet" href="css/index1.css">
    <title>Satisfaction Employeur- Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
    ?>
        <div class="container-fluid h-100">
            <div class="row rows align-items-center text-center">
                <div class="mainText">L'avis des étudiants nous importe</div>
            </div>
            <div class="row rows align-items-center text-center">
                <div class="col-12 d-flex justify-content-evenly">
                    <a href="smileysCount/high.php?eoU=<?php echo 1; ?>" class="hrefSmiley"> <img class="img-fluid" src="img/smiley_smidoeuf.png" width="300px" height="300px"> </a>
                    <a href="smileysCount/mid.php?eoU=<?php echo 1; ?>" class="hrefSmiley"> <img class="img-fluid" src="img/smiley_mid.png" width="300px" height="300px"> </a>
                    <a href="smileysCount/low.php?eoU=<?php echo 1; ?>" class="hrefSmiley"> <img class="img-fluid" src="img/smiley_bad.png" width="300px" height="300px"> </a>
                </div>
            </div>
        </div>
    <?php
    } else {
        header("Location: connexion.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>