<head>
    <title>Categorieën</title>
</head>

<?php
include "inc/header.php";
echo '<header class="head">';
echo '<a href="categorie_new.php" class="btn-new"><i class="material-icons md-24">add</i></a>';
echo '</header>';
echo '<main class="main-content">';

?>
<table id="customers">
    <tr>
        <th>Categorie id</th>
        <th>Naam</th>
        <th>BTW percentage</th>
        <th>Acties</th>
    </tr>
    <?php
    $query = "SELECT categorieën.* FROM categorieën";
    $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
    $aantal = mysqli_num_rows($result);
    $contentTable = "";

    if ($aantal > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $contentTable .= "<tr>";
            $contentTable .= "<td>" . $row['categorie_id'] . "</td>";
            $contentTable .= "<td>" . $row['categorie_naam'] . "</td>";
            $contentTable .= "<td style='text-align: right;'>" . $row['btw_percentage'] . "</td>";
            $contentTable .= "<td>
                                        <a href='categorie_edit.php?id={$row['categorie_id']}' class='btn-edit'>
                                        <i class='material-icons md-24'>edit</i></a>
                                        <a href='categorie_delete.php?id={$row['categorie_id']}' class='btn-delete'>
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