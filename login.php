<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirjautuminen</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js" defer></script>
</head>

<body>


    <div class="navbar">

        <a href="login.php">Kirjäudu sisään</a>
        <a href="rekisteri.php">Rekisteröidy</a>

    </div>

    <div class="container">

        <h2>Kirjautuminen</h2>

        <form method="post">

        <input type="text" name="username" placeholder="Käyttäjätunnus"><br><br>

        <input type="password" name="password" placeholder="Salasana"><br><br>

        <button type="submit" name="login">Kirjaudu</button>

        </form>

    </div>


    <?php

        $yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

        if ($yhteys->connect_error) {
            die("Yhteys epäonnistui: " . $yhteys->connect_error);
        }

        $yhteys->set_charset("utf8");


        if(isset($_POST["login"])){

            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM käyttäjät WHERE Käyttäjätunnus='$username' AND Salasana='$password'";

            $result = $yhteys->query($sql);

            if($result->num_rows == 1){

                $user = $result->fetch_assoc();

                $_SESSION["rooli"] = $user["Rooli"];


                $_SESSION["username"] = $user["Käyttäjätunnus"];

        
                header("Location: haku.php");
                exit();

            }
            else{

                echo "<p>Väärä käyttäjätunnus tai salasana</p>";

            }

        }

    ?>

    
    <footer>
        <p>
            <a href="tietosuoja.php">Tietosuojaseloste</a>
        </p>
    </footer>

</body>
</html>