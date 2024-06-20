<?php
include "inc/header.php";

echo '<header class="head">';
echo '<p>Verwerken van gegevens</p>';
echo '</header>';
echo '<main class="main-content">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"] ? $_POST["action"] : 'leeg';
    switch ($action) {
        case "InsertMedewerker":
            insertMedewerker();
            break;
        case "UpdateMedewerker":
            updateMedewerker();
            break;
        case "DeleteMedewerker":
            deleteMedewerker();
            break;
        case "InsertProduct":
            insertProduct();
            break;
        case "UpdateProduct":
            updateProduct();
            break;
        case "DeleteProduct":
            deleteProduct();
            break;
        case "InsertCategorie":
            insertCategorie();
            break;
        case "UpdateCategorie":
            updateCategorie();
            break;
        case "LEEG":
        default:
            echo "Geen actie gevonden";
            break;
    }
}

function insertMedewerker()
{
    global $dbconn;
    $naam = $_POST["medewerker_naam"];
    $mail = $_POST["medewerker_mail"];
    $wachtwoord = $_POST["medewerker_ww"];
    $pincode = $_POST["medewerker_pin"];
    $rolid = $_POST["rol_id"];

    $query = "INSERT INTO medewerkers (medewerker_naam, medewerker_mail, medewerker_ww, medewerker_pin, rol_id) VALUES ('$naam', '$mail', '$wachtwoord', '$pincode', '$rolid')";
    if (mysqli_query($dbconn, $query)) {
        echo "Nieuwe medewerker is toegevoegd";
        header("Refresh: 2; url=medewerker.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbconn);
    }
}

function updateMedewerker()
{
    global $dbconn;
    $id = $_POST["medewerker_id"];
    $naam = $_POST["medewerker_naam"];
    $mail = $_POST["medewerker_mail"];
    $wachtwoord = $_POST["medewerker_ww"];
    $pincode = $_POST["medewerker_pin"];
    $rolid = $_POST["rol_id"];
    $query = "UPDATE medewerkers SET medewerker_naam='$naam', medewerker_mail='$mail', medewerker_ww='$wachtwoord', medewerker_pin='$pincode', rol_id='$rolid' WHERE medewerker_id='$id'";
    if (mysqli_query($dbconn, $query)) {
        echo "Medewerkergegevens zijn bijgewerkt";
        header("Refresh: 2; url=medewerker.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbconn);
    }
}

function deleteMedewerker()
{
    global $dbconn;
    $id = $_POST["medewerker_id"];
    $query = "DELETE FROM medewerkers WHERE medewerker_id='$id'";
    if (mysqli_query($dbconn, $query)) {
        echo "medewerker is verwijderd";
        header("Refresh: 2; url=medewerker.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbconn);
    }
}

function insertProduct()
{
    global $dbconn;
    $product_id = $_POST["product_id"];
    $product_naam = $_POST["product_naam"];
    $prijs = $_POST["prijs"];
    $categorie_id = $_POST["categorie_id"];
    $aantal = $_POST["aantal"];

    $query1 = "INSERT INTO producten (product_id, product_naam, prijs, categorie_id)
    VALUES ('$product_id', '$product_naam', '$prijs', '$categorie_id')";

    $query2 = "INSERT INTO voorraad (product_id, aantal)
    VALUES ('$product_id', '$aantal')";

    if (mysqli_query($dbconn, $query1) && mysqli_query($dbconn, $query2)) {
        echo "Nieuw product is toegevoegd";
        header("Refresh: 2; url=voorraad.php");
    } else {
        echo "Error: " . mysqli_error($dbconn);
    }
}

function updateProduct()
{
    global $dbconn;
    $product_id = $_POST["product_id"];
    $product_naam = $_POST["product_naam"];
    $prijs = $_POST["prijs"];
    $categorie_id = $_POST["categorie_id"];
    $aantal = $_POST["aantal"];
    $query1 = "UPDATE producten 
    SET product_naam = '$product_naam', prijs = '$prijs', categorie_id = '$categorie_id' 
    WHERE product_id = '$product_id'";
    $query2 = "UPDATE voorraad 
    SET aantal = '$aantal'
    WHERE product_id = '$product_id'";
    if (mysqli_query($dbconn, $query1) && mysqli_query($dbconn, $query2)) {
        echo "Productgegevens zijn bijgewerkt";
        header("Refresh: 1; url=voorraad.php");
    } else {
        echo "Error: " . mysqli_error($dbconn);
    }
}

function deleteProduct()
{
    global $dbconn;
    $product_id = $_POST["product_id"];
    $sql_delete_voorraad = "DELETE FROM voorraad WHERE product_id = $product_id";
    mysqli_query($dbconn, $sql_delete_voorraad);
    $sql_delete_product = "DELETE FROM producten WHERE product_id = $product_id";
    mysqli_query($dbconn, $sql_delete_product);

    if (mysqli_query($dbconn, $sql_delete_product) && mysqli_query($dbconn, $sql_delete_voorraad)) {
        echo "Productgegevens zijn verwijderd";
        header("Refresh: 1; url=voorraad.php");
    } else {
        echo "Error: " . mysqli_error($dbconn);
    }
}

function insertCategorie()
{
    global $dbconn;
    $categorie_naam = $_POST["categorie_naam"];
    $btw_percentage = $_POST["btw_percentage"];
    $query = "INSERT INTO categorieën (categorie_naam, btw_percentage) VALUES ('$categorie_naam', '$btw_percentage')";
    if (mysqli_query($dbconn, $query)) {
        echo "Nieuwe categorie is toegevoegd";
        header("Refresh: 2; url=categorie.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbconn);
    }
}

function updateCategorie()
{
    global $dbconn;
    $categorie_id = $_POST["categorie_id"];
    $categorie_naam = $_POST["categorie_naam"];
    $btw_percentage = $_POST["btw_percentage"];
    $query = "UPDATE categorieën SET categorie_naam='$categorie_naam', btw_percentage='$btw_percentage' WHERE categorie_id='$categorie_id'";
    if (mysqli_query($dbconn, $query)) {
        echo "Categoriegegevens zijn bijgewerkt";
        header("Refresh: 2; url=categorie.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbconn);
    }
}

echo '</main>';

include "inc/footer.php";
?>