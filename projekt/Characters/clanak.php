<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Toy story"/>
    <meta name="author" content="Zvonimir Škegro"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta name="description" content="Page about Toy story"/>
    <title>Buzz Lightyear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <img class="logo" src="../images/Toy_Story_logo.svg.png" width="200px">
        <nav class="navbar navbar-expand-sm justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../index.html">Characters</a></li>
                <li class="nav-item"><a class="nav-link" href="../buzzvswoody.php">Buzz vs Woody</a></li>
                <li class="nav-item"><a class="nav-link" href="">Buzz</a></li>
                <li class="nav-item"><a class="nav-link" href="">Woody</a></li>
                <li class="nav-item"><a class="nav-link" href="../unos.php">Comment</a></li>
                <li class="nav-item"><a class="nav-link" href="../registracija.php">Registration</a></li>
                <li class="nav-item"><a class="nav-link" href="../administracija.php">Administration</a></li>
            </ul>
        </nav>
    </header>

    <?php
        $opis = "Buzz Lightyear is the deuteragonist of the Disney•Pixar Toy Story franchise. He is a heroic spaceman action figure originally belonging to Andy Davis. <br><br>

                Depicted as a Space Ranger working under the authority of the Star Command, Buzz was created during a time where astronauts were especially popular amongst children. Because of this, his arrival in the original Toy Story film created conflict with Andy's favorite toy, Sheriff Woody, though this rivalry would eventually blossom into a lifelong friendship. <br><br>

                The fictional Buzz Lightyear and his adventures would be explored in two spin-off projects: The 2000-2001 animated series Buzz Lightyear of Star Command and the 2022 film Lightyear.";
        $backround = "Buzz is a toy from a science fiction franchise of the same name. In his fictional backstory, Buzz is a universal space ranger from the Intergalactic Alliance and the captain of the Alliance's team. Buzz is trained in several forms of martial arts and is a highly skilled warrior in hand-to-hand combat. Being in peak physical condition, Buzz makes a perfect space ranger and is an example to many.";
        $physical = "Buzz Lightyear is a brawny electronic spaceman action figure. He has fair skin, blue eyes, an outline of a swirl on his chin (which gives Buzz a cleft chin), a purple head cap and collar, a clear plastic space helmet with purple buttons on both sides that open or close it. His green torso consists of a light blue sticker that has the words 'SPACE RANGER' and the Star Command symbol, purple straps connected to it, three oval talk buttons - one blue, one green, and one red, a yellow name tag that says 'LIGHTYEAR' above a red button that pops out purple plastic glider wings with red and white candy cane lining on the top of each, and green ends with red and green flashing lights. On his back, he has a white jetpack with a purple valve and green triangular accents and two black and yellow stickers - one says, 'DANGER', and the other says 'JET EXHAUST'. His white arms have gray circular elbows and matching spheres on the end of his upper arms with black rings on it. His gloves have purple lines on his knuckles and fingertips and green squares on the back of each. His right arm has a red button on his upper arm with a yellow and black striped sticker that reads 'LASER' and a red light on his right wrist. His left arm has a Space Ranger symbol sticker on his upper arm and a communicator sticker in his wrist communicator (the latter of which is later peeled off) and 'MADE IN TAIWAN' engraved inside on his lid of the wrist communicator. A black bending with a thin green waist. His white spaceman pants have matching collars at the bottom and gray spheres behind his knees and hold his white shoes with green toe accents, purple soles, and black handwriting reading 'ANDY' on his right shoe sole.";

    ?>

    <article class="container">
        <h1>Buzz Lightyear</h1>
        <img src="../images/buzz clanak.webp" width="100%" alt="">
        <p>        
            <?php echo $opis; ?>
        </p>

        
        <h3>Backround</h3>
        <p>
        <?php echo $backround; ?>            
        </p>

        <h3>Physical appearance</h3>
        <p>
        <?php echo $physical; ?>
        </p>
    </article>

    <footer>
        Zvonimir Škegro zskegro@tvz.hr 2024.
    </footer>    
</body>