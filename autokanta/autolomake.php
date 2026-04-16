<!DOCTYPE html>
<html>
<head>
	<title>Autolomake</title>
</head>
<body>
	<h4>Syötä auton tiedot:</h4>
	<form action="final_phpTaskPart2_autolomake_Razuvaev_p16.12.25.php" method="post">
		<input type="text" name="rekisteri" placeholder="Rekisterinro"/><br><br>
		<input type="text" name="vari" placeholder="Väri"/><br><br>
		<input type="text" name="vuosimalli" placeholder="Vuosimalli"/><br><br>
		<select name="omistaja" >
			<option value="281182-070W">Anne Autoilija</option>
			<option value="080173-169T">Matti Miettinen</option>
			<option value="200292-195H">Teemu Tamminen</option>
		</select><br><br>
		<input type="submit" name="lisays" value="Lisää auto"><br><br>

	</form>

	<?php
		$yhteys = new mysqli("localhost", "root", "", "быба");

		if ($yhteys->connect_error) {
			die("Yhteys epäonnistui: " . $yhteys->connect_error);
		}

		$yhteys->set_charset("utf8");

		if (isset($_POST["lisays"])) {



			$rekisteri = $_POST["rekisteri"];
			$vari = $_POST["vari"];
			$vuosimalli = $_POST["vuosimalli"];
			$omistaja = $_POST["omistaja"];

			$checkSql = "SELECT * FROM auto WHERE rekisterinro = '$rekisteri'";
			$checkResult = $yhteys->query($checkSql);

			if ($checkResult->num_rows > 0) {
				echo "Rekisterinumero käytössä!";
			} else {
				$sql = "INSERT INTO auto (rekisterinro, vari, vuosimalli, omistaja) VALUES ('$rekisteri', '$vari', $vuosimalli, '$omistaja')";
				$result = $yhteys->query($sql);

				if ($result) {
					echo "Добавлено";
				}
			}

		}

		

	?>
	</body>
</html>