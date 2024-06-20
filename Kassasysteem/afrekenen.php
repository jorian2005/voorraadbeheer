<head>
    <title>Kruitnagel - Afrekenen</title>
</head>

<?php
include "inc/header.php";
?>

<div class="col-md-8">
    <h1>Bon</h1>
    <p>Medewerker:
        <?php echo $_SESSION['gebruiker'] ?><br>
        Medewerker ID:
        <?php echo $_SESSION["id"] ?>
    </P>
</div>


<div class="col-md-8">
    <table class="table products-table">
        <thead>
            <tr>
                <th>Productcode</th>
                <th>Naam</th>
                <th>Aantal</th>
                <th>Prijs</th>
                <th>BTW</th>
            </tr>
            <?php
            $query = "SELECT orderregels.*, producten.product_naam, producten.prijs, categorieën.btw_percentage
                                    FROM orderregels
                                    INNER JOIN producten ON orderregels.product_id = producten.product_id
                                    INNER JOIN categorieën ON producten.categorie_id = categorieën.categorie_id
                                    WHERE orderregels.order_id IS NULL";
            $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
            $aantal = mysqli_num_rows($result);
            $contentTable = "";
            $totaal_btw_bedrag = 0;
            if ($aantal > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $btw_bedrag = ($row['prijs'] * $row['aantal'] * $row['btw_percentage']) / (100 + $row['btw_percentage']);
                    $totaal_btw_bedrag += $btw_bedrag;
                    $contentTable .= "<tr>";
                    $contentTable .= "<td>" . $row['product_id'] . "</td>";
                    $contentTable .= "<td>" . $row['product_naam'] . "</td>";
                    $contentTable .= "<td>" . $row['aantal'] . "</td>";
                    $contentTable .= "<td>" . $row['prijs'] . "</td>";
                    $contentTable .= "<td>" . number_format($btw_bedrag, 2) . "</td>";
                    $contentTable .= "</tr>";
                }
            } else {
                echo "Geen productgegevens gevonden";
            }
            echo $contentTable;
            ?>

        </thead>
    </table>
    <div class="row">
        <div class="col-md-4">
            <label for="totaalaantal">Totaal aantal:</label>
            <input type="text" id="totaalaantal" class="form-control" readonly>
        </div>
        <div class="col-md-4">
            <label for="totaalprijs">Totale prijs incl. BTW:</label>
            <input type="text" id="totaalprijs" class="form-control" readonly>
        </div>
        <div class="col-md-4">
            <label for="BTWbedrag">BTW bedrag</label>
            <input type="text" class="form-control" value="<?php echo number_format($totaal_btw_bedrag, 2); ?>"
                readonly>
        </div>

        <script>
            <?php
            $sql = "SELECT bonregel_id, SUM(aantal) AS aantal_producten FROM orderregels WHERE order_id IS NULL";
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
            $sql = "SELECT bonregel_id, SUM(totaalprijs) AS prijs_producten FROM orderregels WHERE order_id IS NULL";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $totaal_prijs = 0; 
            
                while ($row = $result->fetch_assoc()) {
                    $prijs_producten = $row['prijs_producten'];
                    $totaal_prijs += $prijs_producten;
                }
                echo "document.getElementById('totaalprijs').value = '" . $totaal_prijs . "';";
            }
            ?>
        </script>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$dbconn) {
        die("Fout bij het verbinden met de database: " . mysqli_connect_error());
    }
    if (!isset($totaal_prijs) || !is_numeric($totaal_prijs)) {
        die("Fout: Ongeldige totaalprijs.");
    }
    if (!isset($totaal_btw_bedrag) || !is_numeric($totaal_btw_bedrag)) {
        die("Fout: Ongeldig totaal BTW-bedrag.");
    }

    $producten_in_lijst = "SELECT * FROM orderregels WHERE order_id IS NULL";

    if ($aantal > 0) {
        $highest_order_id_query = "SELECT MAX(order_id) AS highest_order_id FROM orders";
        $highest_order_id_result = mysqli_query($dbconn, $highest_order_id_query);
        if (!$highest_order_id_result) {
            die("Error bij het ophalen van hoogste order ID: " . mysqli_error($dbconn));
        }
        $highest_order_id_row = mysqli_fetch_assoc($highest_order_id_result);
        $highest_order_id = $highest_order_id_row['highest_order_id'];
        $new_order_id = $highest_order_id + 1;
        if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
            die("Fout: Ongeldig medewerker ID.");
        }
        $medewerker_id = $_SESSION['id'];
        $totaal_bedrag_incl_btw = $totaal_prijs;
        $totaal_bedrag_excl_btw = ($totaal_prijs - $totaal_btw_bedrag);
        $btw_bedrag = $totaal_bedrag_incl_btw - $totaal_bedrag_excl_btw;
        $insert_query = "INSERT INTO orders (order_id, medewerker_id, totaal_bedrag_excl_btw, btw_bedrag, totaal_bedrag_incl_btw)
        VALUES ('$new_order_id', '$medewerker_id', '$totaal_bedrag_excl_btw', '$totaal_btw_bedrag', '$totaal_bedrag_incl_btw')";
        $insert_result = mysqli_query($dbconn, $insert_query);
        if (!$insert_result) {
            die("Error bij toevoegen van order: " . mysqli_error($dbconn));
        }
        $order_id = mysqli_insert_id($dbconn);
        $update_query = "UPDATE orderregels SET order_id = '$order_id' WHERE order_id IS NULL";
        $update_result = mysqli_query($dbconn, $update_query);
        if (!$update_result) {
            die("Error bij updaten van order ID in orderregels: " . mysqli_error($dbconn));
        }
        echo "Order gegenereerd! Order ID: " . $order_id;
    } else {
        header("Location: index.php");
        exit();
    }
}

?>

<div class="col-md-4">
    <form action="index.php">
        <input type="submit" value="Terug naar kassa" class="btn btn-primary">
    </form>
</div>