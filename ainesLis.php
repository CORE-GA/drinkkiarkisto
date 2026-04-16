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
    <title>Aines Lisäys</title>

	<link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js" defer></script>
</head>
<body>
	<div class="container">
		<h4>Lisää aine:</h4>
		<form action="ainesLis.php" method="post">
			<input type="text" name="aines" placeholder="Lisää aine"/><br><br>
			<input type="submit" name="lisays" value="Lisää"><br><br>

		</form>

		<?php
			$yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

			if ($yhteys->connect_error) {
				die("Yhteys epäonnistui: " . $yhteys->connect_error);
			}

			$yhteys->set_charset("utf8");


			$kaikkiaineet = "SELECT * FROM aines";
			$printaineet = $yhteys->query($kaikkiaineet);

			if ($printaineet->num_rows > 0) {
				while ($row = $printaineet->fetch_assoc()){
					echo ($row["Nimi"] . "<br>");
				}
			}

			if (isset($_POST["lisays"])) {

				$aines = $_POST["aines"];

				$checkSql = "SELECT * FROM aines WHERE Nimi = '$aines'";
				$checkResult = $yhteys->query($checkSql);


				if ($checkResult->num_rows > 0) {
					echo "<br> Aine on jo lisätty <br>";
				} else {
					$sql = "INSERT INTO aines (Nimi) VALUE ('$aines');";
					$result = $yhteys->query($sql);

					if ($result) {
						echo "Lisätty";
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