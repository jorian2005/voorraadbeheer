<head>
    <title>Kruitnagel - Product Toevoegen</title>
</head>

<?php
include "inc/header.php";
echo '<header class="head">';
echo '</header>';
echo '<main class="main-content">';

echo '<div id="frmDetail">';
?>
<div>
    <form action="dataverwerken.php" method="post" class="frmDetail">
        <input type="hidden" name="action" value="InsertProduct">
        <div class="form-group">
            <label for="product_id">Productcode:</label>
            <input type="number" name="product_id" id="product_id" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="product_naam">Naam:</label>
            <input type="text" name="product_naam" id="product_naam" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="prijs">Prijs:</label>
            <input type="text" name="prijs" id="prijs" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="categorie_id">categorie id:</label>
            <input type="number" name="categorie_id" id="categorie_id" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="aantal">voorradig:</label>
            <input type="number" name="aantal" id="aantal" class="form-control" value="">
        </div>
        <div class="submitbtn">
            <input type="submit" value="Opslaan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php
echo '</div>'; 
echo '</main>';
include "inc/footer.php";
?>