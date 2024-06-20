<head>
    <title>Kruitnagel - Dagrapport</title>
</head>

<?php
include "inc/header.php";
echo '<header class="head">';
echo '<a href="medewerker_new.php" class="btn-new"><i class="material-icons md-24">add</i></a>';
echo '</header>';
echo '<main class="main-content">';

?>

<h1>Dagrappport</h1>

<table id="customers">
    <tr>
        <th>Order id</th>
        <th>Datum</th>
        <th>Medewerker ID</th>
        <th>Totaal excl. BTW</th>
        <th>BTW</th>
        <th>Totaal incl. BTW</th>
    </tr>
    <?php
    $query = "SELECT orders.* FROM orders WHERE datum = CURDATE()";
    $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
    $aantal = mysqli_num_rows($result);
    $contentTable = "";

    if ($aantal > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $contentTable .= "<tr>";
            $contentTable .= "<td>" . $row['order_id'] . "</td>";
            $contentTable .= "<td>" . $row['datum'] . "</td>";
            $contentTable .= "<td>" . $row['medewerker_id'] . "</td>";
            $contentTable .= "<td style='text-align: right;'> € " . number_format($row['totaal_bedrag_excl_btw'],2,",",".") . "</td>";
            $contentTable .= "<td style='text-align: right;'> € " . number_format($row['btw_bedrag'],2,",",".") . "</td>";
            $contentTable .= "<td style='text-align: right;'> € " . number_format($row['totaal_bedrag_incl_btw'],2,",",".") . "</td>";
            $contentTable .= "</tr>";
        }

    } else {
        echo "Geen orders gevonden";
    }
    $contentTable .= "</table>";
    echo $contentTable;
    ?>
    <br>
    <center>
    <div class="row">
        <div class="col-md-4">
            <label for="totaalaantal">Totaal aantal orders:</label>
            <input type="text" id="totaalaantal" class="form-control" readonly>
        </div>
        <div class="col-md-4">
            <label for="totaalomzet">Totaal omzet excl. BTW:</label>
            <input type="text" id="totaalomzet" class="form-control" readonly>
        </div>
        <div class="col-md-4">
            <label for="totaalinclomzet">Totaal omzet incl. BTW:</label>
            <input type="text" id="totaalinclomzet" class="form-control" readonly>
        </div>
        <script>
            <?php
            $sql = "SELECT order_id, count(*) AS aantal_producten FROM orders
            WHERE datum = CURDATE()";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $totaal_aantal = 0; 
            
                while ($row = $result->fetch_assoc()) {
                    $aantal_producten = $row['aantal_producten'];
                    $totaal_aantal += $aantal_producten;
                }
                echo "document.getElementById('totaalaantal').value = '" . $totaal_aantal . "';";
            }
            ?>
        </script>
        <script>
            <?php
            $sql = "SELECT order_id, sum(totaal_bedrag_excl_btw) AS totaal_bedrag_excl_btw FROM orders
            WHERE datum = CURDATE()";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $totaal_aantal = 0; 
            
                while ($row = $result->fetch_assoc()) {
                    $totaal_omzet = $row['totaal_bedrag_excl_btw'];
                    $totaal_aantal += $totaal_omzet;
                }
                echo "document.getElementById('totaalomzet').value = '€ " . $totaal_aantal . "';";
            }
            ?>
        </script>
        <script>
            <?php
            $sql = "SELECT order_id, sum(totaal_bedrag_incl_btw) AS totaal_bedrag_incl_btw FROM orders
            WHERE datum = CURDATE()";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $totaal_incl = 0;
                while ($row = $result->fetch_assoc()) {
                    $totaal_omzet_incl = $row['totaal_bedrag_incl_btw'];
                    $totaal_incl += $totaal_omzet_incl;
                }
                echo "document.getElementById('totaalinclomzet').value = '€ " . $totaal_incl . "';";
            }
            ?>
        </script>
    </div>
    </center>
    </main>
    <?php
    include "inc/footer.php";
    ?>