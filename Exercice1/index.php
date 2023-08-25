<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Héros</title>
</head>
<body>
    <div class="container-fluid text-center h-100">
        <div class="offset-xl-2">
            <div class="col-xl-10">
                <?php
                    $aleatoire = rand(0,2);
                    $langue = rand(0,1);
                    $paragrapheMarvelFrancais = "L'univers cinématographique Marvel (en anglais : Marvel Cinematic Universe, parfois abrégé en MCU) est 
                        une franchise cinématographique produite par Marvel Studios mettant en scène des personnages de bandes dessinées de 
                        l'éditeur Marvel Comics, imaginée et mise en route par Kevin Feige à partir de 2008. Marvel Studios est la propriété 
                        de The Walt Disney Company. Les films qui font partie de cet univers partagé sont, à l'origine, ceux mettant en vedette Les Avengers, un groupe 
                        de super-héros comprenant Iron Man, Hulk, Thor, Black Widow, Hawkeye et Captain America. Sorti en 2008, c'est le film Iron Man qui lance cet 
                        univers et donc, la première phase, qui se terminera par la sortie d'Avengers en 20121. La seconde phase débute avec la sortie de Iron Man 3 en 2013 et 
                        s'est conclue avec Ant-Man en 2015. La troisième phase, quant à elle, a débuté lors de la sortie de Captain America: Civil War en 2016, et s'est achevée en 
                        2019 avec la sortie de Spider-Man: Far From Home.";
                    $paragrapheMarvelAnglais = "The Marvel Cinematic Universe (MCU) is an American media franchise and shared universe centered on a 
                        series of superhero films produced by Marvel Studios. The films are based on characters that appear in American comic books published by Marvel Comics. 
                        The franchise also includes television series, short films, digital series, and literature. The shared 
                        universe, much like the original Marvel Universe in comic books, was established by crossing over common plot elements, settings, cast, and characters.
                        Marvel Studios releases its films in groups called \"Phases\", with the first three phases collectively known as \"The Infinity Saga\" and the following three phases 
                        as \"The Multiverse Saga\". The first MCU film, Iron Man (2008), began Phase One, which culminated in the 2012 crossover film The Avengers. Phase Two began with Iron Man 3 
                        (2013) and concluded with Ant-Man (2015). Phase Three began with Captain America: Civil War (2016) and concluded with Spider-Man: Far From Home (2019).";
                    $paragrapheDCFrancais = "DC Comics est l'une des principales maisons d’édition américaines de comics. DC Comics fait partie 
                        du conglomérat WarnerMedia. Présentation des trois bandes dessinées de super-héros de DC: Superman, Batman et 
                        Wonder Woman. Les initiales « DC » sont une abréviation de « Detective Comics ». DC comporte plusieurs filiales, notamment Vertigo, 
                        dévolue au fantastique, et Wildstorm, plutôt dévolue à la science-fiction et aux aventures de super-héros plus modernes. L'origine de DC 
                        Comics remonte à l'année 1934 lorsque Malcolm Wheeler-Nicholson, un ancien major de l'armée américaine devenu auteur pour des pulps, fonde 
                        la société National Allied Publications. En février 1935 est publié le premier numéro de New Fun Comics qui propose des comics inédits, ce 
                        qui alors le démarque des autres comic books dans lesquels on ne trouve que des rééditions de comic strips."; 
                    $paragrapheDCAnglais = "DC Comics, Inc. (doing business as DC) is an American comic book publisher and the flagship unit of DC Entertainment,[6][7] a 
                        subsidiary of Warner Bros. Discovery.[8][9]
                        DC Comics is one of the largest and oldest American comic book companies, with their first comic 
                        under the DC banner being published in 1937.[10] The majority of its publications take place within the fictional 
                        DC Universe and feature numerous culturally iconic heroic characters, such as Superman, Batman, Wonder 
                        Woman, Flash, Aquaman, Green Lantern, Martian Manhunter, and Cyborg; as well as famous fictional teams 
                        including the Justice League, the Justice Society of America, the Justice League Dark, the Doom Patrol, 
                        and the Teen Titans.";
                    $paragrapheXMENFrancais = "Les X-Men est le nom d'une équipe de super-héros évoluant dans l'univers 
                        Marvel de la maison d'édition Marvel Comics. Créée par le scénariste Stan Lee 
                        et le dessinateur Jack Kirby, l'équipe apparaît pour la première fois dans le 
                        comic book X-Men #1 en septembre 1963. L'équipe, composée en majoritéa de mutants, est à l'origine 
                        dirigée par le professeur Charles Xavier, également connu sous le nom de « Professeur X », un puissant 
                        mutant télépathe qui peut lire dans les pensées et les contrôler. Dans ses premières aventures, l'équipe a 
                        comme principal adversaire Magnéto, un puissant mutant capable de générer et de contrôler les champs magnétiques 
                        qui est à la tête de la Confrérie des mauvais mutants.";
                    $paragrapheXMENAnglais = "The X-Men are a superhero team appearing in American comic 
                        books published by Marvel Comics. Created by artist/co-plotter Jack Kirby and writer/editor Stan Lee, 
                        the team first appearing in The X-Men #1 (September 1963).[1] Although initially cancelled in 1970 due 
                        to low sales, following its 1975 revival and subsequent direction under writer Chris Claremont, it 
                        became one of the most recognizable and successful franchises of Marvel Comics.[2] They have appeared 
                        in numerous books, television shows, the Disney's 20th Century Studios X-Men films, and video games. The 
                        X-Men title may refer to the superhero team itself, the eponymous comic series, or the broader 
                        franchise including various solo titles and team books such as the New Mutants, Excalibur, and X-Force.";
                    if ($aleatoire == 0) {
                        echo "<h1>MARVEL</h1>";
                        if ($langue == 0) {
                            echo "<p>$paragrapheMarvelFrancais</p>";
                        } else {
                            echo "<p>$paragrapheMarvelAnglais</p>";
                        }
                        echo "<img src='img/OIP.png' class='img-fluid'>";
                        
                    } elseif ($aleatoire == 1) {
                        echo "<h1>DC</h1>";
                        if ($langue == 0) {
                            echo "<p>$paragrapheDCFrancais</p>";
                        } else {
                            echo "<p>$paragrapheDCAnglais</p>";
                        }
                        echo "<img src='img/thumb-1920-1104546.jpg' class='img-fluid'>";
                    } else{
                        echo "<h1>X-MEN</h1>";
                        if ($langue == 0) {
                            echo "<p>$paragrapheXMENFrancais</p>";
                        } else {
                            echo "<p>$paragrapheXMENAnglais</p>";
                        }
                        echo "<p></p>";
                        echo "<img src='img/510036.jpg' class='img-fluid'>";
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>