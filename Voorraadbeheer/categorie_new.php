<head>
    <title>Kruitnagel - Categorie Toevoegen</title>
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
        <input type="hidden" name="action" value="InsertCategorie">
        <div class="form-group">
            <label for="categorie_naam">Categorie Naam:</label>
            <input type="text" name="categorie_naam" id="categorie_naam" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="btw_percentage">BTW Percentage</label>
            <input type="text" name="btw_percentage" id="btw_percentage" class="form-control" value="">
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