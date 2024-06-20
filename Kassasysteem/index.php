<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kruitnagel - Kassa</title>
    <link rel="icon" href="Logo_K_trans_1.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>

<body>
    <?php
    include "inc/header.php";
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="keyboard">
                            <div class="container mt-5">
                                <form id="numericForm" method="post" action="save_order.php">
                                    <div class="mb-3">
                                        <input type="text" id="productCode" name="productCode" class="form-control"
                                            placeholder="Productcode" autofocus autocomplete="off">

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="key" onclick="addKey(1)">1</div>
                                            <div class="key" onclick="addKey(4)">4</div>
                                            <div class="key" onclick="addKey(7)">7</div>
                                            <div class="key" onclick="addKey('Del')">Del</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="key" onclick="addKey(2)">2</div>
                                            <div class="key" onclick="addKey(5)">5</div>
                                            <div class="key" onclick="addKey(8)">8</div>
                                            <div class="key" onclick="addKey(0)">0</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="key" onclick="addKey(3)">3</div>
                                            <div class="key" onclick="addKey(6)">6</div>
                                            <div class="key" onclick="addKey(9)">9</div>
                                            <div class="key" onclick="addProduct()">Ent</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table products-table">
                            <thead>
                                <tr>
                                    <th style='text-align: center;'>Productcode</th>
                                    <th style='text-align: center;'>Naam</th>
                                    <th style='text-align: center;'>Aantal</th>
                                    <th style='text-align: center;'>Prijs</th>
                                    <th style='text-align: center;'>BTW</th>
                                    <th style='text-align: center;'>Actie</th>
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
                                        $contentTable .= "<td style='text-align: right;'> € " . number_format($row['prijs'],2,",",".") . "</td>";
                                        $contentTable .= "<td style='text-align: right;'> € " . number_format($btw_bedrag ,2,",",".") . "</td>";
                                        $contentTable .= "<td>
                                                            <form method='post' action='del_product.php'>
                                                                <input type='hidden' name='bonregel_id' value='" . $row['bonregel_id'] . "'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Verwijderen</button>
                                                            </form>
                                                        </td>";
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
                                <input type="text" id="totaalprijs" class="form-control" readonly style="text-align: right;">
                            </div>
                            <div class="col-md-4">
                                <label for="BTWbedrag">BTW bedrag</label>
                                <input type="text" class="form-control"
                                    value="€ <?php echo number_format($totaal_btw_bedrag,2,",","."); ?>" readonly style="text-align: right;">
                            </div>
                            <script>
                                <?php
                                $sql = "SELECT bonregel_id, SUM(aantal) AS aantal_producten FROM orderregels 
                                    WHERE order_id IS NULL";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $totaal_aantal = 0; 
                                    while ($row = $result->fetch_assoc()) {
                                        $aantal_producten = $row['aantal_producten'];
                                        $totaal_aantal += $aantal_producten;
                                    }
                                    echo "
                                    document.getElementById('totaalaantal').value = '" . $totaal_aantal . "';";
                                }
                                ?>
                            </script>
                            <script>
                                <?php
                                $sql = "SELECT bonregel_id, SUM(totaalprijs) AS prijs_producten FROM orderregels 
                                    WHERE order_id IS NULL";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $totaal_prijs = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $prijs_producten = $row['prijs_producten'];
                                        $totaal_prijs += $prijs_producten;
                                    }
                                    echo 
                                    "document.getElementById('totaalprijs').value = '€ " . number_format($totaal_prijs ,2,",",".") . "';
                                    ";
                                }
                                ?>
                            </script>
                        </div>
                    </div>
                    <form method="POST" action="afrekenen.php">
                        <input type="hidden" name="parameter1" value="value1">
                        <input type="hidden" name="parameter2" value="value2">
                        <button type="submit" class="btn btn-primary">Afrekenen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function addKey(key) {
            const productCodeInput = document.getElementById("productCode");

            if (key === 'Del') {
                productCodeInput.value = productCodeInput.value.slice(0, -1);
            } else {
                productCodeInput.value += key;
            }
        }

        function getProductDetails(productCode) {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const product = JSON.parse(xhr.responseText);
                        if (product) {
                            addProductToList(product);
                        } else {
                            console.error('Product bestaat niet.');
                        }
                    } else {
                        console.error('Er was een probleem met de aanvraag.');
                    }
                }
            };
            xhr.open("GET", `get_product_details.php?product_id=${productCode}`, true);
            xhr.send();
        }

        function addProduct() {
            const productCodeInput = document.getElementById("productCode");
            const productCode = productCodeInput.value.trim();
            document.getElementById("numericForm").submit();

            if (productCode === "") {
                return;
            }
            getProductDetails(productCode);

            productCodeInput.value = "";
        }

        function updateTotalPrice() {
            let totalQuantity = 0;
            let totalPrice = 0;

            const tableRows = document.querySelectorAll(".products-table tbody tr");
            tableRows.forEach(row => {
                const quantityInput = row.querySelector("input[type='number']");
                const priceCell = row.querySelector("td:nth-child(4)");

                let quantity = parseInt(quantityInput.value);
                const price = parseFloat(priceCell.innerText);

                if (quantity > 0) {
                    totalQuantity += quantity;
                    totalPrice += quantity * price;
                } else {
                    row.remove();
                }
            });

            document.getElementById("totalQuantity").value = totalQuantity;
            document.getElementById("totalPrice").value = totalPrice.toFixed(2);
        }


        function addProductToList(product) {
            const quantityInput = document.createElement("input");
            quantityInput.type = "number";
            quantityInput.value = 1;
            quantityInput.addEventListener("change", updateTotalPrice);

            if (quantityInput.value <= 0) {
                console.error('Aantal moet groter zijn dan 0.');
                return;
            }

            const productList = document.getElementById("productList");

            const row = document.createElement("tr");
            row.innerHTML = `
    <td>${product.productcode}</td>
    <td>${product.naam}</td>
    <td><input type="number" value="1" onchange="updateTotalPrice()"></td>
    <td>${product.prijs}</td>
    <td>
        <form method='post' action='del_product.php'>
            <input type='hidden' name='bonregel_id' value='${product.bonregel_id}'>
            <button type='submit' class='btn btn-danger btn-sm'>Verwijderen</button>
        </form>
    </td>`;
            productList.appendChild(row);

            updateTotalPrice();
        }

    </script>
    <form id="productForm" method="post">
        <input type="hidden" id="product_code" name="product_code" value="">
    </form>
</body>

</html>