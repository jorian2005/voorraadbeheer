<?php
include "inc/header.php";

if (isset($_POST['bonregel_id'])) {
    $bonregel_id = mysqli_real_escape_string($conn, $_POST['bonregel_id']);

    $sql = "DELETE FROM orderregels WHERE bonregel_id = '$bonregel_id' AND order_id IS NULL";

    if (mysqli_query($conn, $sql)) {
        echo "Bonregel succesvol verwijderd.";
        header("Location: index.php");
    } else {
        echo "Fout bij het verwijderen van de bonregel: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
 