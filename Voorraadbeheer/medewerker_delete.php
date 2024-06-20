<head>
    <title>Kruitnagel - Medewerker Verwijderen</title>
</head>

<?php
include "inc/header.php";
echo '<main class="main-content">';

echo '<div id="frmDetail">';
if (isset($_GET['id'])) {
    $medewerkerId = $_GET['id'];
} else {
    header("Refresh: 2; url=medewerker.php");
    exit();
}

$queryMedewerker = "SELECT * FROM medewerkers WHERE medewerker_id = $medewerkerId";
$resultMedewerker = mysqli_query($dbconn, $queryMedewerker) or die("Error: " . mysqli_error($dbconn));
if (!mysqli_num_rows($resultMedewerker) == 1) {
    echo "Geen medewerkers gevonden";
    header("Refresh: 2; url=medewerker.php");
    exit();
}
$medewerker = mysqli_fetch_assoc($resultMedewerker);
?>

<div>
    <form action="dataverwerken.php" method="post" class="frmDetail">
        <input type="hidden" name="action" value="DeleteMedewerker">
        <label for="medewerker_id">medewerker id:</label>
        <input type="text" name="medewerker_id" id="medewerker_id" value="<?php echo $medewerker['medewerker_id']; ?>" readonly>
        <label for="medewerker_naam">Naam:</label>
        <input type="text" name="medewerker_naam" id="medewerker_naam" value="<?php echo $medewerker['medewerker_naam']; ?>"readonly>
        <label for="medewerker_mail">Mail:</label>
        <input type="text" name="medewerker_mail" id="medewerker_mail" value="<?php echo $medewerker['medewerker_mail']; ?>"readonly>
        <div class="submitbtn">
            <input type="submit" value="Medewerker verwijderen?" class="btnDetailSubmit">
        </div>
    </form>
</div>

<?php
echo '</div>';
echo '</main>';
include "inc/footer.php";
?>