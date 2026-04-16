<!DOCTYPE html>
<html>
<head>
	<title>Autohaku</title>
</head>
<body>
	<h4>Syötä rekisterinumero:</h4>
	<form action="final_phpTask1Part1_autohaku_Razuvaev_p16.12.25.php" method="post">
		<input type="text" name="rekisterinro" /><br><br>
		<input type="submit" name="hae" /><br><br>
	</form>

	<?php

	$yhteys = new mysqli("localhost", "root", "", "быба");

	if ($yhteys->connect_error) {
		die("Yhteys epäonnistui: " . $yhteys->connect_error);
	}

	$yhteys->set_charset("utf8");


	if(isset($_POST["hae"])) {
	
		$text = $_POST["rekisterinro"];
		$search = "SELECT * FROM auto WHERE rekisterinro LIKE '%$text%'";

		$result = $yhteys->query($search);

		if ($result->num_rows > 0){
			while($line = $result->fetch_assoc()){
				echo "{$line["rekisterinro"]} <br>" ;
			}
		}else{echo "No result";}
	}

	?>
	
	</body>
</html>