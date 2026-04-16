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
    <title>Ehdotus</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js"></script>

</head>

<script>
    function addRow() {
        let container = document.getElementById("ingredients");
        let firstRow = document.querySelector(".ingredient-row");
        let newRow = firstRow.cloneNode(true);

        newRow.querySelector("select").selectedIndex = 0;
        newRow.querySelector("input").value = "";

        container.appendChild(newRow);
    }
</script>

<body>

 

    <div class="container">
        <h4>Ehdota reseptin:</h4>
        <form action="ehdotus.php" method="post">
            <input type="text" name="name" placeholder="Nimi"/><br><br>
            <input type="text" name="drinktype" placeholder="Juomalaji"/><br><br>
            <?php
            $yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");
            $yhteys->set_charset("utf8");

            $result = $yhteys->query("SELECT * FROM Aines ORDER BY Nimi ASC");
            ?>

            <div id="ingredients">

                <div class="ingredient-row">
                    <select name="aines_id[]">
                        <option value="">Valitse aines</option>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <option value="<?= $row['Aineksen_ID']; ?>">
                                <?= $row['Nimi']; ?>
                            </option>
                        <?php } ?>
                    </select>

                    <input type="text" name="maara[]" placeholder="Määrä">
                </div>

            </div>
            <br>

            <textarea name="ohjeet" placeholder="Ohjeet" rows="5" cols="50"></textarea><br><br>

            <button type="button" onclick="addRow()">➕</button>
            <br><br>

            <input type="submit" name="done" value="Rekisteröidy"><br><br>
        </form>
    </div>

	<?php
		$yhteys = new mysqli("localhost", "root", "", "drinkitgrigorii");

		if ($yhteys->connect_error) {
			die("Yhteys epäonnistui: " . $yhteys->connect_error);
		}

		$yhteys->set_charset("utf8");


		if (isset($_POST["done"])) {

			$name = $_POST["name"];
            $drinktype = $_POST["drinktype"];
            $ohjeet = $_POST["ohjeet"];

			$checkSql = "SELECT * FROM resepti WHERE Reseptin_nimi = '$name'";
			$checkResult = $yhteys->query($checkSql);
 
            if ($name != "" ){
                if ($checkResult->num_rows > 0) {
                    echo "<br> Tämä drinkki on jo lisätty <br>";
                } else {
                    $sql = "INSERT INTO resepti (Reseptin_nimi, Juomalaji, Ohjet, Hyväksytty) VALUE ('$name', '$drinktype', '$ohjeet', 0);";
                    $result = $yhteys->query($sql);

                    if ($result) {
                        echo "Lisätty";
                        
                    $reseptiId = $yhteys->insert_id;
                    $maara = $_POST["maara"] ;
                    $aines_id = $_POST["aines_id"];
                    

                    for ($i = 0; $i < count($maara); $i++){
                            $sql = "INSERT INTO aines_määrä (Määrä, Reseptin_ID, Aineksen_ID) VALUE ('$maara[$i]', '$reseptiId', '$aines_id[$i]');";
                            $result = $yhteys->query($sql);
                            if ($result) {
                                echo "määrä lisätty";
                            }
                    }

                    }
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