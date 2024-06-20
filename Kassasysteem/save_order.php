<?php
include "inc/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["productCode"];
    $aantal = 1;

    $check_query = "SELECT * FROM producten WHERE product_id = '$product_id'";
    $check_result = $dbconn->query($check_query);

    if ($check_result->num_rows > 0) {
        $get_price_query = "SELECT prijs FROM producten WHERE product_id = '$product_id'";
        $result = $dbconn->query($get_price_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $prijs = $row["prijs"];
        } else {
            $prijs = 0; 
        }

        $insert_query = "INSERT INTO orderregels (product_id, aantal, totaalprijs) VALUES ('$product_id', '$aantal', '$prijs')";

        if ($dbconn !== null && $dbconn->query($insert_query) === TRUE) {
            session_start();
            $_SESSION["success_message"] = "Ingevoerde waarde is succesvol opgeslagen!";
        } else {
            session_start();
            $_SESSION["error_message"] = "Er is een fout opgetreden: " . $dbconn->error;
            header("Location: index.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION["error_message"] = "Product met productcode '$product_id' bestaat niet.";
        header("Location: index.php");
        exit();
    }

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>