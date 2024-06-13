<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Toy story"/>
    <meta name="author" content="Zvonimir Škegro"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="description" content="Page about Toy story"/>
    <title>News</title>
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
                $MySQL = mysqli_connect("localhost","root","","projekt") or die('Error connecting to MySQL server.');

                $query = "SELECT * FROM komentari WHERE arhiva=0 AND lik='buzz'";
                $result = mysqli_query($MySQL, $query);

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo'
                            <div class="col-4 clanci">
                                <h4>
                                    '.$row['ime'].'
                                </h4>

                                <p>
                                    '.$row['komentar'].'
                                </p>

                                <img src="images/'.$row['slika'].'" alt="" height="200px">
                            </div>';
                    }
                }

            ?>
        </div>

        <?php
            mysqli_close($MySQL);
        ?>

    </article>
    <br><br>

    <footer>
            Zvonimir Škegro zskegro@tvz.hr 2024.
    </footer>
</body>
</html>