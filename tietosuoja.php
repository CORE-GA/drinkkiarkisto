<?php
session_start();

if(!isset($_SESSION["rooli"])){
    include_once('naviGuest.php');
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
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Tietosuojaseloste</title>

    <link rel="stylesheet" href="munTyyli.css">
    <script src="munJava.js" defer></script>
</head>
<body>

    <div class="container">
        <h2>TIETOSUOJASELOSTE</h2>

        <h3>1. Rekisterinpitäjä</h3>
        Drinkkiarkisto-projekti<br>
        Ylläpitäjä: Grigorii<br>
        Sähköposti: grigorii.razuvaev2@edu.omnia.fi

        <h3>2. Rekisterin nimi</h3>
        Drinkkiarkiston käyttäjärekisteri

        <h3>3. Henkilötietojen käsittelyn tarkoitus</h3>
        Henkilötietoja kerätään käyttäjien rekisteröintiä ja kirjautumista varten.
        Tietoja käytetään käyttäjätunnusten hallintaan sekä palvelun
        toiminnallisuuden mahdollistamiseen.

        <h3>4. Rekisterin tietosisältö</h3>
        Rekisteriin tallennetaan seuraavat tiedot:
        <ul>
            <li>Käyttäjätunnus</li>
            <li>Sähköpostiosoite</li>
            <li>Salasana (salattuna)</li>
            <li>Käyttäjän rooli (user/admin)</li>
        </ul>

        <h3>5. Säännönmukaiset tietolähteet</h3>
        Tiedot saadaan käyttäjältä itseltään rekisteröitymisen yhteydessä.

        <h3>6. Tietojen luovutus</h3>
        Tietoja ei luovuteta kolmansille osapuolille.

        <h3>7. Tietojen siirto EU:n tai ETA:n ulkopuolelle</h3>
        Tietoja ei siirretä EU:n tai ETA:n ulkopuolelle.

        <h3>8. Rekisterin suojauksen periaatteet</h3>
        Tietokanta on suojattu käyttäjätunnuksella ja salasanalla.
        Pääsy tietoihin on vain rekisterinpitäjällä.
        Salasanat tallennetaan salattuina.

        <h3>9. Tarkastusoikeus</h3>
        Käyttäjällä on oikeus tarkistaa omat tietonsa ja pyytää niiden
        korjaamista tai poistamista ottamalla yhteyttä rekisterinpitäjään.

        <h3>10. Tietojen säilytysaika</h3>
        Tietoja säilytetään niin kauan kuin käyttäjätili on aktiivinen
        tai kunnes käyttäjä pyytää tietojen poistamista.
        
    </div>


</body>
</html>