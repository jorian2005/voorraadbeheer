<head>
    <title>Kruitnagel - Startpagina</title>
</head>

<?php
include "inc/header.php";
echo '<header class="head">';
echo '</header>';
echo '<main class="main-content">';

echo "<h1>Welkom " . $_SESSION['gebruiker'] . "</h1>";
echo '<p>Welkom op de voorraadbeheerpagina van de winkel. <br> Hier kunt u producten en voorraad beheren.</p>';

echo '</main>';

include "inc/footer.php";
?>