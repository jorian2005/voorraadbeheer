<?php
include "inc/database.php";

global $dbconn;
$query = "DELETE FROM orderregels WHERE order_id IS NULL";

if (mysqli_query($dbconn, $query)) {
    echo "Order verwijderd.";
    header("Refresh: 0; url=index.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($dbconn);
}
?>