<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/zoom.css">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.cegeptr.qc.ca/wp-content/themes/acolyte-2_1_5/assets/icons/favicon-96x96.png">
    <title>Focus - Cégep de Trois-Rivières</title>
</head>

<body>
    <?php
    if ($_SESSION["connexion"] == true) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $bd = "smileyFace";
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
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tile">
                                        <div class="wrapper">
                                            <div class="header"><?php echo $row['nom']; ?> </div>
                                            <div class="row g-0">
                                                <div class="col-6">
                                                    <div class="dates">
                                                        <div class="start">
                                                            <strong>Département:</strong> <?php echo $row['departement']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="noBordeRightLieu">
                                                        <div>
                                                            <strong>Lieu:</strong> <?php echo $row['lieu']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="noBordeRightdate">
                                                <div>
                                                    <strong>Date:</strong> <?php echo $row['date']; ?>
                                                </div>
                                            </div>
                                            <div class="row g-0">
                                                <div class="col-6 stat statyy">
                                                    <div class="stats">
                                                        <strong>High</strong>
                                                        <p class="getValueBackGround" id="EtuHigh"><?php echo round($resultEtu[0], 2); ?>%</p>
                                                    </div>
                                                    <div class="stats">
                                                        <strong>Mid</strong>
                                                        <p class="getValueBackGround" id="EtuMid"><?php echo round($resultEtu[1], 2); ?>%</p>
                                                    </div>
                                                    <div class="stats borderlow">
                                                        <strong>Low</strong>
                                                        <p class="getValueBackGround" id="EtuLow"><?php echo round($resultEtu[2], 2); ?>%</p>
                                                    </div>
                                                </div>
                                                <div class="stat col-6">
                                                    <div class="stats">
                                                        <strong>High</strong>
                                                        <p class="getValueBackGround"><?php echo round($resultEmplo[0], 2); ?>%</p>
                                                    </div>
                                                    <div class="stats">
                                                        <strong>Mid</strong>
                                                        <p class="getValueBackGround"><?php echo round($resultEmplo[1], 2); ?>%</p>
                                                    </div>
                                                    <div class="noBordeRightstat borderlow">
                                                        <strong>Low</strong>
                                                        <p class="getValueBackGround"><?php echo round($resultEmplo[2], 2); ?>%</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-0">
                                                <div class="col-6">
                                                    <div class="middle-container p-0">
                                                        <div class="m-2">
                                                            Étudiant
                                                        </div>
                                                        <div class="pie1 middle" id="pie1"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="middle-container1 p-0">
                                                        <div class="m-2">
                                                            Employé
                                                        </div>
                                                        <div class="pie middle" id="pie"></div>
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
                                            <div class="row g-0">
                                                <div class="col-6 stat statyy">
                                                    <div class="stats">
                                                        <strong>High</strong>
                                                        <?php
                                                        $satisfactionValues = [
                                                            "highEtu" => "smiley_smidoeuf.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                            echo $rowSatis[$satisfactionKey] . " ";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="stats">
                                                        <strong>Mid</strong>
                                                        <?php
                                                        $satisfactionValues = [
                                                            "midEtu" => "smiley_mid.png",
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                            echo $rowSatis[$satisfactionKey] . " ";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="stats borderlow">
                                                        <strong>Low</strong>
                                                        <?php
                                                        $satisfactionValues = [
                                                            "lowEtu" => "smiley_bad.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                            echo $rowSatis[$satisfactionKey] . " ";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="stat col-6">
                                                    <div class="stats">
                                                        <strong>High</strong>
                                                        <?php
                                                        $satisfactionValues = [
                                                            "highEmplo" => "smiley_smidoeuf.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                            echo $rowSatis[$satisfactionKey] . " ";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="stats">
                                                        <strong>Mid</strong>
                                                        <?php
                                                        $satisfactionValues = [
                                                            "midEmplo" => "smiley_mid.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                            echo $rowSatis[$satisfactionKey] . " ";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="noBordeRightstat borderlow">
                                                        <strong>Low</strong>
                                                        <?php
                                                        $satisfactionValues = [
                                                            "lowEmplo" => "smiley_bad.png"
                                                        ];
                                                        foreach ($satisfactionValues as $satisfactionKey => $satisfactionImage) {
                                                            echo '<img class="img-fluid littleSmileys" src="img/' . $satisfactionImage . '" width="20px" height="20px">';
                                                            echo $rowSatis[$satisfactionKey] . " ";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $pourhigh = $valeurhigh / $tot * 100;
        $pourmid = $valeurmid / $tot * 100;
        $pourlow = $valeurlow / $tot * 100;
        return [$pourhigh, $pourmid, $pourlow];
    }
    function calcMoyene($valeurhigh, $valeurmid, $valeurlow)
    {
        $totalmem1 = $valeurhigh + $valeurmid + $valeurlow;
        $pourcenthigh1 = $valeurhigh / $totalmem1 * 100;
        $pourcentmid1 = $valeurmid / $totalmem1 * 50;
        $pourcentlow1 = $valeurlow / $totalmem1 * 0;
        $totalmem1 = $pourcenthigh1 + $pourcentmid1 + $pourcentlow1;
        return $totalmem1;
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>