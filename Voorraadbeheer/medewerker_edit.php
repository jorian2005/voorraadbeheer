<head>
    <title>Kruitnagel - Medewerker Bewerken</title>
</head>

<?php
include "inc/header.php";
echo '<main class="main-content">';

echo '<div id="frmDetail">';
if (isset($_GET['id'])) {
    $medewerker_id = $_GET['id'];
} else {
    header("Refresh: 2; url=medewerker.php");
    exit();
}

$queryMedewerker = "SELECT * FROM medewerkers WHERE medewerker_id = $medewerker_id";
$resultMedewerker = mysqli_query($dbconn, $queryMedewerker) or die("Error: " . mysqli_error($dbconn));
if (!mysqli_num_rows($resultMedewerker) == 1) {
    echo "Geen medewerker gevonden";
    header("Refresh: 2; url=medewerker.php");
    exit();
}
$medewerker = mysqli_fetch_assoc($resultMedewerker);
?>

<div>
    <form action="dataverwerken.php" method="post" class="frmDetail">
        <input type="hidden" name="action" value="UpdateMedewerker">
        <label for="medewerker_id">medewerker id:</label>
        <input type="text" name="medewerker_id" id="medewerker_id" value="<?php echo $medewerker['medewerker_id']; ?>" readonly>
        <label for="medewerker_naam">Naam:</label>
        <input type="text" name="medewerker_naam" id="medewerker_naam" value="<?php echo $medewerker['medewerker_naam']; ?>">
        <label for="medewerker_mail">Mail:</label>
        <input type="text" name="medewerker_mail" id="medewerker_mail" value="<?php echo $medewerker['medewerker_mail']; ?>">
        <label for="medewerker_ww">Wachtwoord:</label>
        <input type="text" name="medewerker_ww" id="medewerker_ww" value="<?php echo $medewerker['medewerker_ww']; ?>">
        <label for="medewerker_pin">Pincode:</label>
        <input type="text" name="medewerker_pin" id="medewerker_pin" value="<?php echo $medewerker['medewerker_pin']; ?>">
        <label for="rol_id">Rol ID:</label>
        <input type="text" name="rol_id" id="rol_id" value="<?php echo $medewerker['rol_id']; ?>">
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