<head>
    <title>Kruitnagel - Medewerkers</title>
</head>


<?php
include "inc/header.php";
echo '<header class="head">';
echo '<a href="medewerker_new.php" class="btn-new"><i class="material-icons md-24">add</i></a>';
echo '</header>';
echo '<main class="main-content">';
?>
<table id="customers"> 
    <tr>
        <th></th>
        <th>Naam</th>
        <th>Mailadres</th>
        <th>Wachtwoord</th>
        <th>Pincode</th>
        <th>Rol</th>
        <th>Acties</th>
    </tr>
    <?php
    $query = "SELECT medewerkers.*, rollen.rol_naam FROM medewerkers INNER JOIN rollen on medewerkers.rol_id = rollen.rol_id";
    $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
    $aantal = mysqli_num_rows($result);
    $contentTable = "";

    if ($aantal > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $contentTable .= "<tr>";
            $contentTable .= "<td>" . $row['medewerker_id'] . "</td>";
            $contentTable .= "<td>" . $row['medewerker_naam'] . "</td>";
            $contentTable .= "<td>" . $row['medewerker_mail'] . "</td>";
            $contentTable .= "<td>" . $row['medewerker_ww'] . "</td>";
            $contentTable .= "<td>" . $row['medewerker_pin'] . "</td>";
            $contentTable .= "<td>" . $row['rol_naam'] . "</td>";
            $contentTable .= "<td>
                                        <a href='medewerker_edit.php?id={$row['medewerker_id']}' class='btn-edit'>
                                        <i class='material-icons md-24'>edit</i></a>
                                        <a href='medewerker_delete.php?id={$row['medewerker_id']}' class='btn-delete'>
                                        <i class='material-icons md-24'>delete</i></a>
                                    </td>";
            $contentTable .= "</tr>";
        }

    } else {
        echo "Geen medewerkers gevonden";
    }
    $contentTable .= "</table>";
    echo $contentTable;
    echo '</main>';
    include "inc/footer.php";
    ?>