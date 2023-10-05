<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/zoom.css">
    <title>Focus - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require("connexionServeur.php");
            $conn = new mysqli($servername, $username, $password, $bd);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT idEvent, nom, departement, lieu, date FROM event WHERE idEvent=$id";
            $sqlSatis = "SELECT idSatisfaction, highEtu, midEtu, lowEtu, highEmplo, midEmplo, lowEmplo FROM satisfaction WHERE idSatisfaction=$id";
            $conn->query('SET NAMES utf8');
            $result = $conn->query($sql);
            $resultSatis = $conn->query($sqlSatis);
    ?>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($rowSatis = $resultSatis->fetch_assoc()) {
                        $resultEtu = calc($rowSatis['highEtu'], $rowSatis['midEtu'], $rowSatis['lowEtu']);
                        $resultEmplo = calc($rowSatis['highEmplo'], $rowSatis['midEmplo'], $rowSatis['lowEmplo']);
                        $resultEtuMoyenne = calcMoyene($rowSatis['highEtu'], $rowSatis['midEtu'], $rowSatis['lowEtu']);
                        $resultEmploMoyenne = calcMoyene($rowSatis['highEmplo'], $rowSatis['midEmplo'], $rowSatis['lowEmplo']);
            ?>
                        <div>
                            <!-- NAVBAR -->
                            <div class="topnav" id="myTopnav">
                            <div>
                                    <a href="https://www.cegeptr.qc.ca/">Cégep TR</a>
                                </div>
                                <div>
                                    <a href="eventBD.php">Évènements</a>
                                    <a href="userBD.php">Utilisateurs</a>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn"><?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?>
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="index1.php">Vote Étudiant</a>
                                        <a href="index.php">Vote Employé</a>
                                        <a href="deconnexion.php">Déconnexion</a>
                                    </div>
                                </div>

                                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                            </div>
                            <div class="containerStats">
                                <h1><strong><?php echo $row['nom']; ?> </strong></h1>
                                <h4>Date:<strong> <?php echo $row['date']; ?></strong></h4>
                                <div class="rowForCols">
                                    <div class="column6">
                                        <h3>Lieu:<strong> <?php echo $row['lieu']; ?></strong></h3>
                                    </div>
                                    <div class="column6">
                                        <h3>Département:<strong> <?php echo $row['departement']; ?></strong></h3>
                                    </div>
                                </div>
                                <div class="rowForCols">
                                    <div class="column12">
                                        <h3>Les statistiques</h3>
                                    </div>
                                </div>

                                <div class="rowForCols miniScreenFlexDirection">
                                    <div class="column6">
                                        <h4>Les étudiants</h4>
                                        <div class="rowForCols">
                                            <div class="column4">
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "highEtu" => "smiley_smidoeuf.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "highEtu" => "smiley_smidoeuf.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="column4">
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "midEtu" => "smiley_mid.png",
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "midEtu" => "smiley_mid.png",
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="column4">
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "lowEtu" => "smiley_bad.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "lowEtu" => "smiley_bad.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rowForCols miniScreenFlexDirection">
                                            <div class="column4">
                                                <div class="getValueBackGround" id="EtuHigh"><?php echo round($resultEtu[0], 2); ?>%</div>
                                            </div>
                                            <div class="column4">
                                                <div class="getValueBackGround" id="EtuMid"><?php echo round($resultEtu[1], 2); ?>%</div>
                                            </div>
                                            <div class="column4">
                                                <div class="getValueBackGround" id="EtuLow"><?php echo round($resultEtu[2], 2); ?>%</div>
                                            </div>
                                        </div>
                                        <div class="rowForCols">
                                            <div class="column12">
                                                <div class="pie1 middle" id="pie1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column6">
                                        <h4>Les employés</h4>
                                        <div class="rowForCols">
                                            <div class="column4">
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "highEmplo" => "smiley_smidoeuf.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {

                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "highEmplo" => "smiley_smidoeuf.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <div class="column4">
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "midEmplo" => "smiley_mid.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {

                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "midEmplo" => "smiley_mid.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <div class="column4">
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "lowEmplo" => "smiley_bad.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {

                                                        echo $rowSatis[$satisfactionKey] . " ";
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    $satisfactionValues = [
                                                        "lowEmplo" => "smiley_bad.png"
                                                    ];
                                                    foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                        echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="rowForCols miniScreenFlexDirection">
                                            <div class="column4">
                                                <div class="getValueBackGround"><?php echo round($resultEmplo[0], 2); ?>%</div>
                                            </div>
                                            <div class="column4">
                                                <div class="getValueBackGround"><?php echo round($resultEmplo[1], 2); ?>%</div>
                                            </div>
                                            <div class="column4">
                                                <div class="getValueBackGround"><?php echo round($resultEmplo[2], 2); ?>%</div>
                                            </div>
                                        </div>
                                        <div class="rowForCols">
                                            <div class="column12">
                                                <div class="pie1 middle" id="pie"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    <?php
                                    $resultEtu[0] = round($resultEtu[0], 2);
                                    $resultEtu[1] = round($resultEtu[1], 2);
                                    $resultEtuMoyenne = round($resultEtuMoyenne, 2);
                                    $resultEmploMoyenne = round($resultEmploMoyenne, 2);
                                    $color = "conic-gradient(#00ff30 " . $resultEtu[0] . "%, #ffe019 " . $resultEtu[0] . "% " . ($resultEtu[0] + $resultEtu[1]) . "%, #ff0000 " . ($resultEtu[1] + $resultEtu[0]) . "%)";
                                    echo "var color ='$color';";
                                    echo "var resultEtuMoyenne ='$resultEtuMoyenne';";
                                    echo "var resultEmploMoyenne ='$resultEmploMoyenne';";
                                    $color1 = "conic-gradient(#00ff30 " . $resultEmplo[0] . "%, #ffe019 " . $resultEmplo[0] . "% " . ($resultEmplo[0] + $resultEmplo[1]) . "%, #ff0000 " . ($resultEmplo[1] + $resultEmplo[0]) . "%)";
                                    echo "var color1 ='$color1';";
                                    ?>
                                    var secteur1 = document.getElementById('pie1');
                                    var secteur2 = document.getElementById('pie');
                                    secteur1.style.backgroundImage = color;
                                    secteur1.innerHTML = resultEtuMoyenne + "%";
                                    secteur1.style.fontSize = "40px";
                                    secteur1.style.fontStyle = "italic";
                                    secteur1.style.fontWeight = "bold";
                                    secteur2.style.backgroundImage = color1;
                                    secteur2.innerHTML = resultEmploMoyenne + "%";
                                    secteur2.style.fontSize = "40px";
                                    secteur2.style.fontStyle = "italic";
                                    secteur2.style.fontWeight = "bold";
                                </script>
                            </div>
                        </div>
    <?php
                    }
                }
            } else {
                echo "Aucun résultats";
            }
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            "erreur";
        }
        $conn->close();
    } else {
        header("Location: connexion.php");
    }
    function calc($valeurhigh, $valeurmid, $valeurlow)
    {
        $tot = $valeurhigh + $valeurmid + $valeurlow;
        if ($tot != 0) {
            $pourhigh = $valeurhigh / $tot * 100;
            $pourmid = $valeurmid / $tot * 100;
            $pourlow = $valeurlow / $tot * 100;
        } else {
            $pourhigh = 0;
            $pourmid = 0;
            $pourlow = 0;
        }
        return [$pourhigh, $pourmid, $pourlow];
    }

    function calcMoyene($valeurhigh, $valeurmid, $valeurlow)
    {
        $totalmem1 = $valeurhigh + $valeurmid + $valeurlow;
        if ($totalmem1 != 0) {
            $pourcenthigh1 = $valeurhigh / $totalmem1 * 100;
            $pourcentmid1 = $valeurmid / $totalmem1 * 50;
            $pourcentlow1 = $valeurlow / $totalmem1 * 0;
        } else {
            $pourcenthigh1 = 0;
            $pourcentmid1 = 0;
            $pourcentlow1 = 0;
        }
        $totalmem1 = $pourcenthigh1 + $pourcentmid1 + $pourcentlow1;
        return $totalmem1;
    }
    ?>
    <script type="text/javascript"></script>
</body>

</html>