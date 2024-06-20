<head>
    <title>Kruitnagel - Medewerker toevoegen</title>
</head>


<?php
include "inc/header.php";
echo '<header class="head">';
echo '</header>';

echo '<main class="main-content">';

echo '<div id="frmDetail">';
?>
<div>
    <form action="dataverwerken.php" method="post" class="frmDetail">
        <input type="hidden" name="action" value="InsertMedewerker">
        <label for="medewerker_naam">Naam:</label>
        <input type="text" name="medewerker_naam" id="medewerker_naam" value="">
        <label for="medewerker_mail">Mailadres:</label>
        <input type="text" name="medewerker_mail" id="medewerker_mail" value="">
        <label for="medewerker_ww">Wachtwoord:</label>
        <input type="text" name="medewerker_ww" id="medewerker_ww" value="">
        <label for="medewerker_pin">Pincode:</label>
        <input type="text" name="medewerker_pin" id="medewerker_pin" value="">
        <label for="rol_id">Rol ID:</label>
        <input type="text" name="rol_id" id="rol_id" value="">
        <div class="submitbtn">
            <input type="submit" value="Opslaan" class="btnDetailSubmit">
        </div>
    </form>
</div>

<?php
echo '</div>';
echo '</main>';
include "inc/footer.php";
?>