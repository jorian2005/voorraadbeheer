<head>
    <title>Kruitnagel - Product Verwijderen</title>
</head>

<?php
include "inc/header.php";
echo '<main class="main-content">';

echo '<div id="frmDetail">';
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    header("Refresh: 2; url=voorraad.php");
    exit();
}

$queryProduct = "SELECT producten.*, voorraad.aantal 
                 FROM producten 
                 LEFT JOIN voorraad ON producten.product_id = voorraad.product_id 
                 WHERE producten.product_id = $product_id";
$resultProduct = mysqli_query($dbconn, $queryProduct) or die("Error: " . mysqli_error($dbconn));
if (!mysqli_num_rows($resultProduct) == 1) {
    echo "Geen productgegevens gevonden";
    header("Refresh: 2; url=voorraad.php");
    exit();
}
$product = mysqli_fetch_assoc($resultProduct);
?>

<div>
    <form action="dataverwerken.php" method="post" class="frmDetail">
        <input type="hidden" name="action" value="DeleteProduct">
        <div class="form-group">
            <label for="product_id">Productcode:</label>
            <input type="number" name="product_id" id="product_id" value="<?php echo $product['product_id']; ?>"
                readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="product_naam">Naam:</label>
            <input type="text" name="product_naam" id="product_naam" value="<?php echo $product['product_naam']; ?>"
                readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="prijs">Prijs:</label>
            <input type="text" name="prijs" id="prijs" value="<?php echo $product['prijs']; ?>" readonly
                class="form-control">
        </div>
        <div class="form-group">
            <label for="categorie_id">Categorie ID:</label>
            <input type="number" name="categorie_id" id="categorie_id" value="<?php echo $product['categorie_id']; ?>"
                readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="aantal">Voorraad:</label>
            <input type="number" name="aantal" id="aantal" value="<?php echo $product['aantal']; ?>" readonly
                class="form-control">
        </div>
        <div class="submitbtn">
            <input type="submit" value="Product verwijderen?" class="btnDetailSubmit">
        </div>
    </form>
</div>

<?php
echo '</div>';
echo '</main>';
include "inc/footer.php";
?>