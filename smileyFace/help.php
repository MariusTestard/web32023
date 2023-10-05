<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/help.css">
    <title>help</title>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == $_GET) {
        $id = $_GET['id'];
        switch ($id) {
            case 1:
                $location = 'connexion.php';
                break;
            case 2:
                $location = 'ajouter.php';
                break;

            case 3:
                $location = 'modifier.php';
                break;
            case 4:
                $location = 'modifier.php';
                break;

            case 5:
                $location = 'create.php';
                break;
            case 6:
                $location = 'newPass.php';
                break;
            case 7:
                $location = 'mail.php';
                break;
        }
    } else {
        $location = 'connexion.php';
    }
    ?>
    <div>
        <div class="topnav" id="myTopnav">
            <div>
                <a href="https://www.cegeptr.qc.ca/">Cégep TR</a>
            </div>
            <div>
                <a href="<?php echo $location; ?>">Revenir</a>
            </div>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
        <div class="bigContainer">
            <div id="container">
                <div class="para">
                    <h1>Connexion</h1>
                    <p>
                        Si vous êtes parvenus sur la page de connexion, cela veut probablement dire que vous êtes un administrateur. Pour vous connecter, veuillez entrez
                        votre numéro d'employé ainsi que votre mot de passe. Si vous voulez gardez le même mot de passe, entrez simplement le même dans le champ en question.
                        Veuilez cliquer sur revenir pour retourner où vous étiez. * Si c'est la première fois que vous vous connectez, le mot de passe sera votre numéro d'employé. Vous serez
                        ensuite amené à une page pour modifier votre mot de passe. *
                    </p>
                </div>
                <div class="para">
                    <h1>Création d'un évènement</h1>
                    <p>
                        Pour créer un évènement, vous devez remplir tous les champs exigés. Vous devrez donc remplir le nom de l'évènement, le département auquel l'évènement appartient (exemple Informatique), le lieu et la date et l'heure quand
                        l'évènement débutera. Veuillez à ne pas oublier de remplir tous les champs, sinon vous aurez à repartir de zéro. Veuilez cliquer sur revenir pour retourner où vous étiez.
                    </p>
                </div>
                <div class="para">
                    <h1>Modification d'un évènement</h1>
                    <p>
                        Pour modifier un évènement, veuillez changer les champs où vous voulez apporter une modification. Comme pour la création d'un évèmenent, veillez à ne pas oublier un champ quelconque. Vous pouvez ainsi changé comme bon vous semble le nom de l'évènement,
                        son département, le lieu de l'évènement et la date ainsi que l'heure. Veuilez cliquer sur revenir pour retourner où vous étiez.
                    </p>
                </div>
                <div class="para">
                    <h1>Création d'un utilisateur</h1>
                    <p>
                        Pour créer un utilisateur, vous devais simplement rentré les informations comme le numéro de l'employé, l'email pour changer son mot de passe en cas d'oublie, le prénom ainsi que le nom de l'employé.
                        Veuilez cliquer sur revenir pour retourner où vous étiez. * Pour ce qui est du mot de passe, il est à noté qu'il sera le même que le numéro de l'employé à la création. Quand l'utilisateur se connectera pour la
                        première fois, il pourra à ce moment-ci changer son mot de passe. *
                    </p>
                </div>
                <div class="para">
                    <h1>Modification de l'usager</h1>
                    <p>
                        Pour modifier un utilisateur, c'est le même principe que pour la modification d'un évènement. Vous allez pouvoir voir les données actuel de l'utiliateur et vous aurez choix de changer le numéro d'employé, l'email pour l'oublie du mot de passe,
                        le prénom ainsi que le nom de l'employé. N'oubliez pas de prendre soin de remplir tous les champs et de ne pas en laisser des vides. Veuilez cliquer sur revenir pour retourner où vous étiez.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
</body>

</html>