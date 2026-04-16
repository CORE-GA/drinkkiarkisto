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
    <title>Hyväksy resepti</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js"></script>

</head>

<body>

    <div class="container">

        <h4>Reseptiehdotukset</h4>

        <?php

            $yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

            if ($yhteys->connect_error) {
                die("Yhteys epäonnistui: " . $yhteys->connect_error);
            }

            $yhteys->set_charset("utf8");


            if(isset($_POST["hyvaksy"])){

                $id = $_POST["resepti_id"];

                $sql = "UPDATE resepti SET Hyväksytty = 1 WHERE Reseptin_ID = '$id'";
                $yhteys->query($sql);

                echo "Resepti hyväksytty <br><br>";
            }



            if(isset($_POST["hylkaa"])){

                $id = $_POST["resepti_id"];

                $sql = "DELETE FROM resepti WHERE Reseptin_ID = '$id'";
                $yhteys->query($sql);

                echo "Resepti hylätty <br><br>";
            }



            $sql = "SELECT * FROM resepti WHERE Hyväksytty = 0";
            $result = $yhteys->query($sql);


            if ($result->num_rows == 0) {

                echo "Ei uusia ehdotuksia.";

            }
            else{

                while($rivi = $result->fetch_assoc()){

                    echo "<b>Nimi:</b> " . $rivi["Reseptin_nimi"] . "<br>";
                    echo "<b>Juomalaji:</b> " . $rivi["Juomalaji"] . "<br>";
                    echo "<b>Ohje:</b> " . $rivi["Ohjet"] . "<br><br>";

                    $reseptiId = $rivi["Reseptin_ID"];


                    echo "
                    <form method='post' style='display:inline'>

                    <input type='hidden' name='resepti_id' value='$reseptiId'>

                    <button type='submit' name='hyvaksy'>Hyväksy</button>

                    <button type='submit' name='hylkaa'>Hylkää</button>

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