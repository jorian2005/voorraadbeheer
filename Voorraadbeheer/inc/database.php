<?php
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "kruitnagel");
$dbconn = "";

try {
    $dbconn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
} catch (Exception $e) {
    echo "Error: " . $e;
}

function fnCloseDb($dbconn)
{
    mysqli_close($dbconn) or die("Error: " . mysqli_error($dbconn));
}
?>