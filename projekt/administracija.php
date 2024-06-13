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
        <div class="row">   
    
   


            <?php 
                session_start(); 
                $dbc = mysqli_connect('localhost', 'root', '', 'projekt');
                if ($dbc->connect_error) {
                    die('Connection failed: ' . $dbc->connect_error);
                }
                // Putanja do direktorija sa slikama 
                define('UPLPATH', 'img/'); 

                $uspjesnaPrijava = false; 
                $admin = false; 

                // Provjera da li je korisnik došao s login forme 
                if (isset($_POST['prijava'])) { 
                    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona 
                    $prijavaImeKorisnika = $_POST['username']; 
                    $prijavaLozinkaKorisnika = $_POST['lozinka']; 
                    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?"; 
                    $stmt = mysqli_stmt_init($dbc); 
                    if (mysqli_stmt_prepare($stmt, $sql)) { 
                        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika); 
                        mysqli_stmt_execute($stmt); 
                        mysqli_stmt_store_result($stmt); 
                        if (mysqli_stmt_num_rows($stmt) > 0) {
                            mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika); 
                            mysqli_stmt_fetch($stmt); 
                            // Provjera lozinke 
                            if (password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika)) { 
                                $uspjesnaPrijava = true;
                                // Provjera da li je admin 
                                if($levelKorisnika == 1) { 
                                    $admin = true; 
                                } 
                                // Postavljanje session varijabli 
                                $_SESSION['username'] = $imeKorisnika; 
                                $_SESSION['level'] = $levelKorisnika; 
                            }
                        }
                        mysqli_stmt_close($stmt); 
                    }
                }

                ?>

                <?php 
                // Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je 
                if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username']) && $_SESSION['$level'] == 1)) { 
                    $query = "SELECT * FROM komentari"; 
                    $result = mysqli_query($dbc, $query); 
                    while($row = mysqli_fetch_array($result)) { 
                        // Forma za administraciju
                        // Prikaz forme za administraciju vijesti ovdje
                            $MySQL = mysqli_connect("localhost","root","","projekt") or die('Error connecting to MySQL server.');




                            $query = "SELECT * FROM komentari";
                            $result = mysqli_query($MySQL, $query);
                            
                            if ($result) {
                                while ($row = mysqli_fetch_array($result)) {
                                    
                                    echo'
                                                <div class="col-3 clanci">
                                                    <h4>
                                                        '.$row['ime'].'
                                                    </h4>

                                                    <p>
                                                        '.$row['komentar'].'
                                                    </p>

                                                    <img src="images/'.$row['slika'].'" alt="" height="100px">
                                                    <br><br>

                                                    <form method="post" action="">
                                                        <input type="hidden" name="id" value="'.$row['id'].'">
                                                        <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                                                        <button type="submit" name="delete" value="Izbriši">Izbriši</button>
                                                    </form>
                                                </div>';
                                    
                                }
                            }
                            if(isset($_POST['delete'])){ 
                                $id=$_POST['id']; 
                                $query = "DELETE FROM komentari WHERE id=$id "; 
                                $result = mysqli_query($MySQL, $query); 
                            }
                    
                
                    }
                } else if ($uspjesnaPrijava && !$admin) { 
                    echo '<p>Bok ' . htmlspecialchars($imeKorisnika) . '! Uspješno ste prijavljeni, ali niste administrator.</p>'; 
                } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
                    echo '<p>Bok ' . htmlspecialchars($_SESSION['$username']) . '! Uspješno ste prijavljeni, ali niste administrator.</p>'; 
                } else if (!$uspjesnaPrijava) { 
                    ?> 
                    <!-- Forma za prijavu -->
                    <form method="POST" action="">
                        <div class="form-item">
                            <label for="username">Korisničko ime: </label>
                            <input type="text" name="username" id="username" class="form-field-textual">
                        </div>
                        <div class="form-item">
                            <label for="lozinka">Lozinka: </label>
                            <input type="password" name="lozinka" id="lozinka" class="form-field-textual">
                        </div>
                        <div class="form-item">
                            <button type="submit" name="prijava" id="prijava">Prijava</button>
                        </div>
                    </form>
                    <script type="text/javascript">
                    // JavaScript validacija forme
                    document.getElementById("prijava").onclick = function(event) {
                        var slanjeForme = true;

                        var poljeUsername = document.getElementById("username");
                        var username = poljeUsername.value;
                        if (username.length == 0) {
                            slanjeForme = false;
                            poljeUsername.style.border = "1px dashed red";
                            alert("Unesite korisničko ime!");
                        } else {
                            poljeUsername.style.border = "1px solid green";
                        }

                        var poljeLozinka = document.getElementById("lozinka");
                        var lozinka = poljeLozinka.value;
                        if (lozinka.length == 0) {
                            slanjeForme = false;
                            poljeLozinka.style.border = "1px dashed red";
                            alert("Unesite lozinku!");
                        } else {
                            poljeLozinka.style.border = "1px solid green";
                        }

                        if (!slanjeForme) {
                            event.preventDefault();
                        }
                    };
                    </script>
                    <?php 
                } 
            ?>
            
        </div>
    </article>

    <br><br>
    <footer>
            Zvonimir Škegro zskegro@tvz.hr 2024.
    </footer>
</body>
</html>