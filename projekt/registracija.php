<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Toy story"/>
    <meta name="author" content="Zvonimir Škegro"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="description" content="Page about Toy story"/>
    <title>Toy story</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .bojaPoruke {color: red;}
    </style>
</head>
<body>
    <header>
        <img class="logo" src="images/Toy_Story_logo.svg.png" width="200px">
        <nav class="navbar navbar-expand-sm justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.html">Characters</a></li>
                <li class="nav-item"><a class="nav-link" href="buzzvswoody.php">Buzz vs Woody</a></li>
                <li class="nav-item"><a class="nav-link" href="buzz.php">Buzz</a></li>
                <li class="nav-item"><a class="nav-link" href="woody.php">Woody</a></li>
                <li class="nav-item"><a class="nav-link" href="unos.php">Comment</a></li>
                <li class="nav-item"><a class="nav-link" href="registracija.php">Registration</a></li>
                <li class="nav-item"><a class="nav-link" href="administracija.php">Administration</a></li>
            </ul>
        </nav>
    </header>

    <article class="container">
        
    <?php

$dbc = mysqli_connect('localhost', 'root', '', 'projekt');
if ($dbc->connect_error) {
    die('Connection failed: ' . $dbc->connect_error);
}

$msg = '';
$registriranKorisnik = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['ime']; 
    $prezime = $_POST['prezime']; 
    $username = $_POST['username']; 
    $lozinka = $_POST['pass']; 
    $hashed_password = password_hash($lozinka, PASSWORD_BCRYPT); 
    $razina = 0;

    // Check if the username already exists
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = $dbc->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $msg = 'Korisničko ime već postoji!';
        } else {
            // Register the new user
            $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
            $stmt = $dbc->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('ssssd', $ime, $prezime, $username, $hashed_password, $razina);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $registriranKorisnik = true;
                }
            }
        }
        $stmt->close();
    }
    $dbc->close();
}

if ($registriranKorisnik) {
    echo '<p>Korisnik je uspješno registriran!</p>';
} else {
?>

<section role="main">
    <form enctype="multipart/form-data" action="" method="POST">
        <div class="form-item">
            <span id="porukaIme" class="bojaPoruke"></span>
            <label for="title">Ime: </label>
            <div class="form-field">
                <input type="text" name="ime" id="ime" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPrezime" class="bojaPoruke"></span>
            <label for="about">Prezime: </label>
            <div class="form-field">
                <input type="text" name="prezime" id="prezime" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <span id="porukaUsername" class="bojaPoruke"></span>
            <label for="content">Korisničko ime:</label>
            <?php echo '<br><span class="bojaPoruke">' . htmlspecialchars($msg) . '</span>'; ?>
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPass" class="bojaPoruke"></span>
            <label for="pphoto">Lozinka: </label>
            <div class="form-field">
                <input type="password" name="pass" id="pass" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPassRep" class="bojaPoruke"></span>
            <label for="pphoto">Ponovite lozinku: </label>
            <div class="form-field">
                <input type="password" name="passRep" id="passRep" class="form-field-textual">
            </div>
        </div>
        <br>
        <div class="form-item">
            <button type="submit" value="Prijava" id="slanje">Prijava</button>
        </div>
    </form>
</section>

<script type="text/javascript">
document.getElementById("slanje").onclick = function(event) {
    var slanjeForme = true;

    // Ime korisnika mora biti uneseno
    var poljeIme = document.getElementById("ime");
    var ime = poljeIme.value;
    if (ime.length == 0) {
        slanjeForme = false;
        poljeIme.style.border = "1px dashed red";
        document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
    } else {
        poljeIme.style.border = "1px solid green";
        document.getElementById("porukaIme").innerHTML = "";
    }

    // Prezime korisnika mora biti uneseno
    var poljePrezime = document.getElementById("prezime");
    var prezime = poljePrezime.value;
    if (prezime.length == 0) {
        slanjeForme = false;
        poljePrezime.style.border = "1px dashed red";
        document.getElementById("porukaPrezime").innerHTML = "<br>Unesite Prezime!<br>";
    } else {
        poljePrezime.style.border = "1px solid green";
        document.getElementById("porukaPrezime").innerHTML = "";
    }

    // Korisničko ime mora biti uneseno
    var poljeUsername = document.getElementById("username");
    var username = poljeUsername.value;
    if (username.length == 0) {
        slanjeForme = false;
        poljeUsername.style.border = "1px dashed red";
        document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
    } else {
        poljeUsername.style.border = "1px solid green";
        document.getElementById("porukaUsername").innerHTML = "";
    }

    // Provjera podudaranja lozinki
    var poljePass = document.getElementById("pass");
    var pass = poljePass.value;
    var poljePassRep = document.getElementById("passRep");
    var passRep = poljePassRep.value;
    if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
        slanjeForme = false;
        poljePass.style.border = "1px dashed red";
        poljePassRep.style.border = "1px dashed red";
        document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste!<br>";
        document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste!<br>";
    } else {
        poljePass.style.border = "1px solid green";
        poljePassRep.style.border = "1px solid green";
        document.getElementById("porukaPass").innerHTML = "";
        document.getElementById("porukaPassRep").innerHTML = "";
    }

    if (!slanjeForme) {
        event.preventDefault();
    }
};
</script>

<?php
}
?>

    </article>

    <br><br>
    <footer>
            Zvonimir Škegro zskegro@tvz.hr 2024.
    </footer>
</body>
</html>










