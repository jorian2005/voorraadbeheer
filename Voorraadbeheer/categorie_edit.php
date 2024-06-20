<head>
    <title>Kruitnagel - Categorie Bewerken</title>
</head>

<?php
include "inc/header.php";

echo '<header class="head">';
echo '</header>';
echo '<main class="main-content">';
echo '<div id="frmDetail">';
?>
<div>
    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $categorie_id = $_GET['id'];

        $query = "SELECT * FROM categorieën WHERE categorie_id = $categorie_id";
        $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <form action="dataverwerken.php" method="post" class="frmDetail">
                <input type="hidden" name="action" value="UpdateCategorie">
                <input type="hidden" name="categorie_id" value="<?php echo $row['categorie_id']; ?>">
                <div class="form-group">
                    <label for="categorie_naam">Categorie Naam:</label>
                    <input type="text" name="categorie_naam" id="categorie_naam" class="form-control"
                        value="<?php echo $row['categorie_naam']; ?>">
                </div>
                <div class="form-group">
                    <label for="btw_percentage">BTW Percentage</label>
                    <input type="text" name="btw_percentage" id="btw_percentage" class="form-control"
                        value="<?php echo $row['btw_percentage']; ?>">
                </div>
                <div class="submitbtn">
                    <input type="submit" value="Opslaan" class="btn btn-primary">
                </div>
            </form>
            <?php
        } else {
            echo "Geen categorie gevonden met dit ID";
        }
    } else {
        echo "Ongeldig ID voor categorie";
    }
    ?>
</div>

<?php
echo '</div>';
echo '</main>';
include "inc/footer.php";
?>