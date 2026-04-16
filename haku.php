<?php
session_start();

if(!isset($_SESSION["rooli"])){
    header("Location: login.php");
    exit();
}else{
    if ($_SESSION["rooli"] == "user"){
        include_once('naviUser.php');
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
    <title>Haku</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js"></script>

<style>
    .choices_db{
        display: flex;
        flex-direction: column;
        gap: 25px;
        align-items: center;
    }

    .radio{
        display: flex;
        gap: 6px;
        font-size: 16px;
    }

    .radio input{
        margin: 0; 
    }
</style>

</head>
<body>

<div class="container">

    <h2>Hae drinkki:</h2>

    <form action="haku.php" method="post">
		<input type="text" name="haku" placeholder="Haku"/><br><br>

		<div class="choices_db">
            <label class="radio">
                <input type="radio" name="choice" value="Nimi">
                Nimi
            </label>

            <label class="radio">
                <input type="radio" name="choice" value="Ainesosa">
                Ainesosa
            </label>
        </div><br>

        <input type="submit" name="laheta" value="Lähetä"><br><br>
    </form>

<?php
$yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

if ($yhteys->connect_error) {
	die("Yhteys epäonnistui: " . $yhteys->connect_error);
}

$yhteys->set_charset("utf8");


if (isset($_POST["laheta"])) {

	$haku = $_POST["haku"];
    if(isset($_POST["choice"])){
        $choice = $_POST["choice"];
    }else{
        $choice = "";
    }

	if ($haku != ""){

		if ($choice == "Nimi"){

			$checkSql = "SELECT * FROM resepti WHERE Reseptin_nimi LIKE '%$haku%'";
			$checkResult = $yhteys->query($checkSql);


			if ($checkResult->num_rows == 0) {
				echo "<br> Reseptiä ei löytynyt <br>";
			} 
			else {

				while($rivi = $checkResult->fetch_assoc()) {

					echo "Nimi: " . $rivi["Reseptin_nimi"] . "<br>";
					echo "Juomalaji: " . $rivi["Juomalaji"] . "<br>";


					$reseptiId = $rivi["Reseptin_ID"];

					$ainesmääräsql = "SELECT * FROM aines_määrä WHERE Reseptin_ID = '$reseptiId'";
					$checkMäärä = $yhteys->query($ainesmääräsql);

					echo "Ainesosat:<br>";


					while($rivi2 = $checkMäärä->fetch_assoc()){


						$Aineksen_Id = $rivi2["Aineksen_ID"];

						$ainessql = "SELECT Nimi FROM aines WHERE Aineksen_ID = '$Aineksen_Id'";
						$checkaines = $yhteys->query($ainessql);


						$ainesrivi = $checkaines->fetch_assoc();
						echo $ainesrivi["Nimi"] . " (" . $rivi2["Määrä"] . ")<br>";
					}

					echo "Ohje: " . $rivi["Ohjet"] . "<br><br>";
				}
			}
		} else if($choice == "Ainesosa"){

            $sql = "SELECT DISTINCT resepti.*
                    FROM resepti
                    JOIN aines_määrä ON resepti.Reseptin_ID = aines_määrä.Reseptin_ID
                    JOIN aines ON aines_määrä.Aineksen_ID = aines.Aineksen_ID
                    WHERE aines.Nimi LIKE '%$haku%'";

            $checkResult = $yhteys->query($sql);

            if ($checkResult->num_rows == 0) {
                echo "<br> Reseptiä ei löytynyt <br>";
            } 
            else {

                while($rivi = $checkResult->fetch_assoc()) {

                    echo "Nimi: " . $rivi["Reseptin_nimi"] . "<br>";
                    echo "Juomalaji: " . $rivi["Juomalaji"] . "<br>";

                    $reseptiId = $rivi["Reseptin_ID"];

                    $ainesmääräsql = "SELECT * FROM aines_määrä WHERE Reseptin_ID = '$reseptiId'";
                    $checkMäärä = $yhteys->query($ainesmääräsql);

                    echo "Ainesosat:<br>";

                    while($rivi2 = $checkMäärä->fetch_assoc()){

                        $Aineksen_Id = $rivi2["Aineksen_ID"];

                        $ainessql = "SELECT Nimi FROM aines WHERE Aineksen_ID = '$Aineksen_Id'";
                        $checkaines = $yhteys->query($ainessql);

                        $ainesrivi = $checkaines->fetch_assoc();
                        echo $ainesrivi["Nimi"] . " (" . $rivi2["Määrä"] . ")<br>";
                    }

                    echo "Ohje: " . $rivi["Ohjet"] . "<br><br>";
                }
            }
        }




	} else{
            $checkSql = "SELECT * FROM resepti";
			$checkResult = $yhteys->query($checkSql);


			if ($checkResult->num_rows == 0) {
				echo "<br> Reseptiä ei löytynyt <br>";
			} 
			else {

				while($rivi = $checkResult->fetch_assoc()) {

					echo "Nimi: " . $rivi["Reseptin_nimi"] . "<br>";
					echo "Juomalaji: " . $rivi["Juomalaji"] . "<br>";


					$reseptiId = $rivi["Reseptin_ID"];

					$ainesmääräsql = "SELECT * FROM aines_määrä WHERE Reseptin_ID = '$reseptiId'";
					$checkMäärä = $yhteys->query($ainesmääräsql);

					echo "Ainesosat:<br>";


					while($rivi2 = $checkMäärä->fetch_assoc()){


						$Aineksen_Id = $rivi2["Aineksen_ID"];

						$ainessql = "SELECT Nimi FROM aines WHERE Aineksen_ID = '$Aineksen_Id'";
						$checkaines = $yhteys->query($ainessql);


						$ainesrivi = $checkaines->fetch_assoc();
						echo $ainesrivi["Nimi"] . " (" . $rivi2["Määrä"] . ")<br>";
					}

					echo "Ohje: " . $rivi["Ohjet"] . "<br><br>";
				}
			}
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