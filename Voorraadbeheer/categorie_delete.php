<head>
    <title>Kruitnagel - Categorie Verwijderen</title>
</head>

<?php
include "inc/header.php";

echo '<main class="main-content">';

echo '<div id="frmDetail">';
if (isset($_GET['id'])) {
    $categorieId = $_GET['id'];
} else {
    echo "Geen categorie ID gevonden.";
    header("Refresh: 2; url=categorie.php");
    exit();
}

$queryCategorie = "SELECT * FROM categorieën WHERE categorie_id = $categorieId";
$resultCategorie = mysqli_query($dbconn, $queryCategorie) or die("Error: " . mysqli_error($dbconn));

if (!mysqli_num_rows($resultCategorie) == 1) {
    echo "Geen categorie gevonden.";
    header("Refresh: 2; url=categorie.php");
    exit();
}

$categorie = mysqli_fetch_assoc($resultCategorie);
?>

<div>
    <form action="dataverwerken.php" method="post" class="frmDetail">
        <input type="hidden" name="action" value="DeleteCategorie">
        <label for="categorie_id">Categorie ID:</label>
        <input type="text" name="categorie_id" id="categorie_id" value="<?php echo $categorie['categorie_id']; ?>"
            readonly>
        <label for="categorie_naam">Naam:</label>
        <input type="text" name="categorie_naam" id="categorie_naam" value="<?php echo $categorie['categorie_naam']; ?>"
            readonly>
        <label for="btw_percentage">BTW Percentage:</label>
        <input type="text" name="btw_percentage" id="btw_percentage" value="<?php echo $categorie['btw_percentage']; ?>"
            readonly>
        <div class="submitbtn">
            <input type="submit" value="Categorie verwijderen?" class="btnDetailSubmit">
        </div>
    </form>
</div>

<?php
echo '</div>';
echo '</main>';
include "inc/footer.php";
?>