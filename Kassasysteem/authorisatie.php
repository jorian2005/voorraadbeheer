<?php
include "inc/header.php";

if ($_POST['submit']) {
    $pincode = $_POST['pincode'];
    
    $sql = "SELECT medewerker_id, medewerker_naam, rol_id FROM medewerkers WHERE CONCAT(medewerker_id, medewerker_pin) = '$pincode'";
    $result = mysqli_query($dbconn, $sql);
    $aantal = mysqli_num_rows($result);

    if ($aantal == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION['gebruiker'] = $row['medewerker_naam'];
        $_SESSION['id'] = $row['medewerker_id'];
        $_SESSION['rol'] = $row['rol_id'];
        $_SESSION['ingelogd'] = true;
        header('refresh:0;url=index.php');
        exit;
    } else {
        echo "Inloggen mislukt, pincode onjuist. Probeer opnieuw in te loggen.";
        session_destroy();
        session_unset();
        mysqli_close($dbconn);
        header('refresh:2;url=login.php');
    }
} else {
    header('refresh:0;url=login.php');
}

include "inc/footer.php";
?>

