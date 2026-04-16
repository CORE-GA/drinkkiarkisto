<?php
session_start();

if(!isset($_SESSION["rooli"])){
    header("Location: login.php");
    exit();
}else{
    if ($_SESSION["rooli"] == "user"){
        include_once('naviUser.php');
        header("Location: haku.php");
    }else if ($_SESSION["rooli"] == "admin"){
        include_once('naviAdmin.php');
    }else{
        include_once('naviGuest.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Käyttäjän poisto</title>

    <link rel="stylesheet" href="munTyyli.css">

</head>

<body>


    <div class="container">
        <h2>Poista käyttäjä:</h2>

        <?php

        $yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

        if ($yhteys->connect_error) {
            die("Yhteys epäonnistui: " . $yhteys->connect_error);
        }

        $yhteys->set_charset("utf8");


        if(isset($_POST["poista"])){

            $id = $_POST["kayttaja_id"];

            $sql = "DELETE FROM käyttäjät WHERE Käyttäjätunnus='$id'";
            $yhteys->query($sql);

            echo "Käyttäjä poistettu<br><br>";
        }


        $sql = "SELECT * FROM käyttäjät";
        $result = $yhteys->query($sql);


        if ($result->num_rows == 0) {

            echo "Käyttäjiä ei löytynyt.";

        }
        else{

            while($rivi = $result->fetch_assoc()){

                echo "Käyttäjä: " . $rivi["Käyttäjätunnus"] . "<br>";
                echo "Rooli: " . $rivi["Rooli"] . "<br>";

                $kayttajaId = $rivi["Käyttäjätunnus"];


                echo "
                <form method='post' style='display:inline'>
                <input type='hidden' name='kayttaja_id' value='$kayttajaId'>
                <button type='submit' name='poista'>Poista</button>
                </form>
                <hr>
                ";

            }

        }

        ?>

    </div>

    <footer>
        <p>
            <a href="tietosuoja.php">Tietosuojaseloste</a>
        </p>
    </footer>
</body>
</html>