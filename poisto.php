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
    <title>Poisto</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js"></script>
</head>
<body>

    <div class="container">
    
        <h4>Poista drinkki</h4>

        <?php
            $yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

            if ($yhteys->connect_error) {
                die("Yhteys epäonnistui: " . $yhteys->connect_error);
            }

            $yhteys->set_charset("utf8");


            if(isset($_POST["poista"])){
                $id = $_POST["resepti_id"];

                $deleteSql = "DELETE FROM resepti WHERE Reseptin_ID = '$id'";
                $yhteys->query($deleteSql);

                echo "Resepti poistettu <br><br>";
            }


            $checkSql = "SELECT * FROM resepti";
            $checkResult = $yhteys->query($checkSql);


            if ($checkResult->num_rows == 0) {
                echo "<br> Reseptiä ei löytynyt <br>";
            } 
            else {

                while($rivi = $checkResult->fetch_assoc()) {

                    echo "Nimi: " . $rivi["Reseptin_nimi"];

                    $reseptiId = $rivi["Reseptin_ID"];


                    echo "
                    <form method='post' style='display:inline'>
                        <input type='hidden' name='resepti_id' value='$reseptiId'>
                        <button type='submit' name='poista'>Poista</button>
                    </form>
                    <br><br>
                    ";


                    $ainesmääräsql = "SELECT * FROM aines_määrä WHERE Reseptin_ID = '$reseptiId'";
                    $checkMäärä = $yhteys->query($ainesmääräsql);

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