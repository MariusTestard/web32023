<?php
session_start();
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/css/butterCake.min.css">
    <title>Password - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["ConnectionFirst"] == true) {
        $numPlo = $_SESSION['numPlo'];
        $passwd = "";
        $errorPasswd = "";
        $erreur = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['newPass'])) {
                $errorPasswd = "Mot de passe manquant";
                $erreur = true;
            } else {
                $passwd = test_input($_POST["newPass"]);
            }
            if ($erreur != true) {
                $newPass = sha1($_POST['newPass']);
                $numEmplo = $_SESSION['numPlo'];
                $servername = "localhost";
                $usernameBD = "root";
                $passwordBD = "root";
                $bd = "smileyFace";
                $conn = new mysqli($servername, $usernameBD, $passwordBD, $bd);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "UPDATE user SET password = '$newPass' WHERE numEmploye = '$numEmplo'";
                $conn->query('SET NAMES utf8');
                if ($conn->query($sql) === TRUE) {
                    echo "Enregistrement réussi";
                    header("Location: connexion.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {   
    ?>
    <section class="login-page flex-center-center py-5 bg-light">
  <div class="w-100 mx-auto px-2" style="max-width: 400px">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="text-center text-gray">
        <h2 class="weight-500 mb-1">Première connexion</h2>
        <p class="h4 mb-2 weight-300">Veuillez entrer votre nouveau mot de passe</p>
      </div>
      <div class="card overflow-unset mt-9 mb-1">
        <div class="card-body">

          
          <div class="avatar-icon text-center">
            <img src="https://yt3.ggpht.com/a/AATXAJyBgyVuLbK5tbpbn8yLLYqX2cU0o5GCmDoToA=s900-c-k-c0xffffffff-no-rj-mo" height="128" width="128" alt="Avatar"
              class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
          </div>

          
          <div class="group">
            <label for="numPlo">Numéro d'employé:</label>
            <input type="text" class="input" placeholder="Numéro d'employé" readonly name="numPlo" value="<?php echo $numPlo ?>">
          </div>

          
          <div class="group">
            <label for="newPass">Nouveau mot de passe:</label>
            <input type="password" class="input" placeholder="Mot de passe" name="newPass">
            <span class="spanErr"><?php echo $errorPasswd; ?></span>
          </div>
          <div class="group"></div>

          <div class="group">
            <button class="btn btncolor block btn-lg weight-500 " type="submit">Changer</button>
          </div>
        </div>
      </div>

      <div class="text-center weight-600 text-gray">
          <a href="" class="text-gray">Besoin d'aide?</a>
      </div>
    </form>
  </div>

</section>

    <?php
    
        }
    } else {
        header("Location: connexion.php");
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/js/butterCake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>