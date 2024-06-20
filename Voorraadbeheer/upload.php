<?php
require_once 'inc/header.php';

function insertOrUpdateProduct($dbconn, $categorie_id, $product_id, $product_naam, $prijs, $aantal)
{
    $aantal = trim($aantal);

    $check_query = "SELECT * FROM producten WHERE product_id = '$product_id'";
    $result = mysqli_query($dbconn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $update_query = "UPDATE voorraad SET aantal = aantal + $aantal WHERE product_id = '$product_id'";
        if (mysqli_query($dbconn, $update_query)) {
            echo "Voorraad van product met ID $product_id is bijgewerkt<br>";
        } else {
            echo "Error bij bijwerken van voorraad van product met ID $product_id: " . mysqli_error($dbconn) . "<br>";
        }
    } else {
        $insert_query = "INSERT INTO producten (product_id, prijs, categorie_id, product_naam)
                        VALUES ('$product_id', '$prijs', '$categorie_id', '$product_naam')";
        $insert_voorraad_query = "INSERT INTO voorraad (product_id, aantal) VALUES ('$product_id', '$aantal')";

        if (mysqli_query($dbconn, $insert_query) && mysqli_query($dbconn, $insert_voorraad_query)) {
            echo "Nieuw product met ID $product_id is toegevoegd<br>";
        } else {
            echo "Error bij toevoegen van product met ID $product_id: " . mysqli_error($dbconn) . "<br>";
        }
    }

    $check_cat_query = "SELECT * FROM categorieën WHERE categorie_id = '$categorie_id'";
    $cat_result = mysqli_query($dbconn, $check_cat_query);

    if (mysqli_num_rows($cat_result) == 0) {
        $insert_cat_query = "INSERT INTO categorieën (categorie_id) VALUES ('$categorie_id')";
        if (mysqli_query($dbconn, $insert_cat_query)) {
            echo "Nieuwe categorie met ID $categorie_id is toegevoegd<br>";
        } else {
            echo "Error bij toevoegen van categorie met ID $categorie_id: " . mysqli_error($dbconn) . "<br>";
        }
    }
}

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";

    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_extensions = array("csv");

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Alleen CSV-bestanden zijn toegestaan.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "Het bestand is succesvol geüpload.<br>";

            if (($handle = fopen($target_file, "r")) !== FALSE) {
                fgetcsv($handle, 1000, ";");

                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { 
                    $categorie_id = $data[0];
                    $product_id = $data[1];
                    $product_naam = $data[2];
                    $prijs = $data[3];
                    $aantal = $data[4];
                    insertOrUpdateProduct($dbconn, $categorie_id, $product_id, $product_naam, $prijs, $aantal);
                }
                fclose($handle);
            } else {
                echo "Kon CSV-bestand niet openen";
            }

        } else {
            echo "Er was een probleem met het uploaden van het bestand.";
        }
    }
    header("Refresh: 1; URL=voorraad.php");
}

?>