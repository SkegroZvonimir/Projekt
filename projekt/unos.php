<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Toy story"/>
    <meta name="author" content="Zvonimir Škegro"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="description" content="Page about Toy story"/>
    <title>Create news</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .greska { color: red; }
    </style>
    <script defer type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("gumb").addEventListener("click", function(event) {
                var ime = document.getElementById("name").value;
                var komentar = document.getElementById("comment").value;
                var slika = document.getElementById("pphoto").value;

                document.getElementById("nameError").innerHTML = "";
                document.getElementById("commentError").innerHTML = "";
                document.getElementById("pictureError").innerHTML = "";

                var validno = true;

                if (ime === "") {
                    document.getElementById("nameError").innerHTML = "Ime je obavezno";
                    validno = false;
                }

                if (komentar.length < 10) {
                    document.getElementById("commentError").innerHTML = "Komentar mora biti dulji od 10 znakova!";
                    validno = false;
                }

                if (slika === "") {
                    document.getElementById("pictureError").innerHTML = "Slika je obavezna!";
                    validno = false;
                }

                if (!validno) {
                    event.preventDefault();
                }
            });
        });
    </script>
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

    <?php

        $MySQL = mysqli_connect("localhost","root","","projekt") or die('Error connecting to MySQL server.');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query  = "INSERT INTO komentari (ime, lik, komentar, slika, arhiva) VALUES ('" . $_POST['name'] . "', '" . $_POST['category'] . "', '" . $_POST['comment'] . "', '" . $_POST['pphoto'] . "', '" . $_POST['archive'] . "')";
            $result = @mysqli_query($MySQL, $query);

            print '<p class="alert alert-success">Komentar je uspješno spremljen!</p>';
        }


    
        print '<div class="container clanci">
            <form method="post">
            
                <div class="form-item"> 
                    <label for="name">Your name:</label> 
                    <div class="form-field"> 
                        <input type="text" name="name" id="name" class="form-field-textual"> 
                    </div>
                    <span id="nameError" class="greska"></span> 
                </div> 

                <br>

                <div class="form-item"> 
                    <label for="category">Character</label> 
                    <div class="form-field"> 
                        <select name="category" id="" class="form-field-textual"> 
                            <option value="buzz">Buzz Lightyear</option> 
                            <option value="woody">Woody</option>
                        </select> 
                    </div> 
                </div>
        
                <br>

                <div class="form-item"> 
                    <label for="komentar">Comment:</label>

                    <div class="form-field"> 
                        <textarea name="comment" id="comment" cols="50" rows="5" class="form field-textual"></textarea> 
                    </div>
                    <span id="commentError" class="greska"></span> 
                </div>

                <br>

                <div class="form-item">  
                    <label for="pphoto">Picture: </label> 
                    <div class="form-field"> 
                        <input type="file" accept="image/jpg,image/gif" class="input-text" id="pphoto" name="pphoto"/> 
                    </div>
                    <span id="pictureError" class="greska"></span> 
                </div> 

                <br>

                <div class="form-item"> 
                    <label>Save in the archive  
                 
                        <input type="checkbox" name="archive"> 
   
                  </label> 
                </div> 

                <br>

                <div class="form-item"> 
                    <button type="reset" value="Cancel">Cancel</button> 
                    <button type="submit" id="gumb" value="Accept">Accept</button> 
                </div> 
            </form>
        </div>';

        mysqli_close($MySQL);
    ?>
    <br><br>

    <footer>
        Zvonimir Škegro zskegro@tvz.hr 2024.
    </footer>    
</body>