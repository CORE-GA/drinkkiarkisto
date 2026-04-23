<!-- Tämä on Grigoriin tekemä rekisteri.php -->
<!-- ------ -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekisteri</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js"></script>

</head>
<body>

    <div class="navbar">

        <a href="login.php">Kirjäudu sisään</a>
        <a href="rekisteri.php">Rekisteröidy</a>

    </div>

    <div class="container">
        <h4>Rekisteröidy drinkkiarkiston käyttäjäksi</h4>
        <form action="rekisteri.php" method="post">
            <input type="text" name="login" placeholder="Käyttäjätunnus"/><br><br>
            <input type="text" name="password" placeholder="Salasana"/><br><br>
            <input type="text" name="email" placeholder="Sähköposti"/><br><br>
            <input type="submit" name="done" class="button" value="Rekisteröidy"><br><br>
        </form>
    </div>

	<?php
		$yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

		if ($yhteys->connect_error) {
			die("Yhteys epäonnistui: " . $yhteys->connect_error);
		}

		$yhteys->set_charset("utf8");


		if (isset($_POST["done"])) {

			$login = $_POST["login"];
            $password = $_POST["password"];
            $email = $_POST["email"];

			$checkSql = "SELECT * FROM käyttäjät WHERE Käyttäjätunnus = '$login'";
			$checkResult = $yhteys->query($checkSql);

            if ($login != ""){
                if ($checkResult->num_rows > 0) {
                    echo "<br> Login on jo ottettu <br>";
                } else {
                    $sql = "INSERT INTO käyttäjät (Käyttäjätunnus, Email, Salasana, Rooli) VALUE ('$login', '$email', '$password', 'user');";
                    $result = $yhteys->query($sql);

                    if ($result) {
                        echo "Lisätty";
                    }

                    header("Location: login.php");
                }
            }
		}

	?>

    <br>
    <footer>
        <p>
            <a href="tietosuoja.php">Tietosuojaseloste</a>
        </p>
    </footer>

</body>
</html>