<?php
include "inc/header.php";

if ($_POST['submit']) {
    $inlognaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
} else
    header('refresh:0;url=login.php');

$sql = "SELECT medewerkers.medewerker_id, medewerkers.medewerker_naam, medewerkers.medewerker_ww, rollen.rol_naam 
FROM medewerkers INNER JOIN rollen 
ON medewerkers.rol_id = rollen.rol_id WHERE medewerker_naam = '$inlognaam' AND medewerker_ww = '$wachtwoord'";

$result = mysqli_query($dbconn, $sql);
$aantal = mysqli_num_rows($result);
if ($aantal == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION['gebruiker'] = $row['medewerker_naam'];
    $_SESSION['rol'] = $row['rol_naam']; 
    $_SESSION['id'] = $row['rol_id']; 
    $_SESSION['ingelogd'] = true;
    header('refresh:0;url=index.php');
    exit;

} else {
    echo "Inloggen mislukt, gebruikersnaam en/of wachtwoord onjuist. Probeer opnieuw in te loggen.";
    session_destroy();
    session_unset();
    mysqli_close($dbconn);
    header('refresh:2;url=login.php');
};

include "inc/footer.php";
?>
