<?php
include "inc/header.php";
echo '<header class="head">';
echo '<p>Verwerken van gegevens</p>';
echo '</header>';
echo '<main class="main-content">';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"] ? $_POST["action"] : 'leeg';
    switch ($action) {
        case "DeleteOrder":
            deleteOrder();
            break;
        case "LEEG":
        default:
            echo "Geen actie gevonden";
            break;
    }
}

function deleteOrder(){
    global $dbconn;
}


echo '</main>';

include "inc/footer.php";
?>