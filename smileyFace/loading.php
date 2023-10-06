<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loading.php</title>
</head>

<body>
        <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
            sleep(2);
            if ($id == 1) {
                header('Location: newPass.php');
            } else {
                header('Location: connexion.php');
            }
        ?>
    </script>
</body>

</html>