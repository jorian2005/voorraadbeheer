<?php
include "inc/database.php";

$product_id = $_GET['product_id'];

$sql = "SELECT * FROM producten INNER JOIN voorraad ON producten.product_id = voorraad.product_id WHERE producten.product_id = $product_id AND voorraad.aantal > 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $voorraad_sql = "SELECT aantal FROM voorraad WHERE product_id = $product_id";
    $voorraad_result = $conn->query($voorraad_sql);

    if ($voorraad_result->num_rows > 0) {
        $voorraad_row = $voorraad_result->fetch_assoc();
        $currentVoorraad = $voorraad_row['aantal'];

        if ($currentVoorraad > 0) {
            $newVoorraad = $currentVoorraad - 1;

            $updateVoorraadSql = "UPDATE voorraad SET aantal = $newVoorraad WHERE product_id = $product_id";
            $conn->query($updateVoorraadSql);

            $productData = array(
                'productcode' => $row['product_id'],
                'naam' => $row['product_naam'],
                'prijs' => $row['prijs'],
                'voorraad' => $newVoorraad 
            );

            echo json_encode($productData);
        } else {
            echo json_encode(array('error' => 'Product is uitverkocht'));
        }
    } else {
        echo json_encode(array('error' => 'Voorraadinformatie niet gevonden'));
    }
} else {
    echo json_encode(array('error' => 'Product niet gevonden'));
}

?>