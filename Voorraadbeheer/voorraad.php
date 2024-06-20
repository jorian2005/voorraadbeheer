<head>
    <title>Kruitnagel - Voorraad</title>
</head>

<?php
include "inc/header.php";
echo '<header class="head">';
echo '<a href="product_new.php" class="btn-new"><i class="material-icons md-24">add</i></a>';
echo '</header>';
echo '<main class="main-content">';

?>
<table id="customers"> 
    <tr>
        <th>Product id</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th>Voorraad</th>
        <th>categorie id</th>
        <th>categorie naam</th>
        <th>BTW percentage</th>
        <th>Acties</th>
    </tr>
    <?php
    $query = "SELECT categorieën.categorie_id, categorieën.categorie_naam, categorieën.btw_percentage, 
    producten.product_id, producten.product_naam, producten.prijs, voorraad.aantal 
    FROM categorieën 
    INNER JOIN producten ON categorieën.categorie_id = producten.categorie_id 
    LEFT JOIN voorraad ON producten.product_id = voorraad.product_id";
    $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
    $aantal = mysqli_num_rows($result);
    $contentTable = "";

    if ($aantal > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $contentTable .= "<tr>";
            $contentTable .= "<td>" . $row['product_id'] . "</td>";
            $contentTable .= "<td>" . $row['product_naam'] . "</td>";
            $contentTable .= "<td style='text-align: right;'>€ " . number_format($row['prijs'],2,",",".") . "</td>";
            $contentTable .= "<td style='text-align: right;'>" . $row['aantal'] . "</td>";
            $contentTable .= "<td>" . $row['categorie_id'] . "</td>";
            $contentTable .= "<td>" . $row['categorie_naam'] . "</td>";
            $contentTable .= "<td style='text-align: right;'>" . $row['btw_percentage'] . "</td>";
            $contentTable .= "<td>
                                        <a href='product_edit.php?id={$row['product_id']}' class='btn-edit'>
                                        <i class='material-icons md-24'>edit</i></a>
                                        <a href='product_delete.php?id={$row['product_id']}' class='btn-delete'>
                                        <i class='material-icons md-24'>delete</i></a>
                                    </td>";
            $contentTable .= "</tr>";
        }

    } else {
        echo "Geen voorraad gevonden";
    }
    $contentTable .= "</table>";
    echo $contentTable;
    echo '</main>';
    include "inc/footer.php";
    ?>