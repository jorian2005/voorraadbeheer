<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kruitnagel - Zoeken</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <link rel="icon" href="Logo_K_trans_1.png">
</head>

<body>
    <?php
    include "inc/header.php";
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <h2>Zoeken naar Product</h2>
                <form action="zoeken.php" method="GET">
                    <div class="form-group">
                        <label for="category">Categorie:</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Alle categorieën</option>
                            <?php
                            $categoryQuery = "SELECT * FROM categorieën";
                            $categoryResult = mysqli_query($dbconn, $categoryQuery);
                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                echo "<option value='" . $category['categorie_id'] . "'";
                                if (isset($_GET['category']) && $_GET['category'] == $category['categorie_id']) {
                                    echo "selected";
                                }
                                echo ">" . $category['categorie_naam'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Zoeken</button>
                </form>

                <div class="mt-4">
                    <?php
                    $query = "SELECT * FROM producten";
                    if (isset($_GET['category']) && !empty($_GET['category'])) {
                        $category = $_GET['category'];
                        $query .= " WHERE categorie_id = '$category'";
                    }

                    $result = mysqli_query($dbconn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <div class="row">
                            <?php
                            while ($product = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-md-4">
                                    <button class="btn btn-primary m-2"
                                        onclick="addProductToList(<?php echo $product['product_id']; ?>)" style="width: 100%">
                                        <?php echo $product['product_id']; ?><br>
                                        <?php echo $product['product_naam']; ?> 
                                    </button>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Geen producten gevonden.</div>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function addProductToList(productID) {
            const quantity = 1;

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            addProduct(response.product);
                            window.location.href = "index.html";
                        } else {
                            console.error('Er was een probleem met het toevoegen van het product aan de orderregels.');
                        }
                    } else {
                        console.error('Er was een probleem met de aanvraag.');
                    }
                }
            };
            xhr.open("POST", "save_order.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(`productCode=${productID}&quantity=${quantity}`);
        }

        function addProduct(product) {
            const productList = document.getElementById("productList");

            const row = document.createElement("tr");
            row.innerHTML = `
        <td>${product.product_id}</td>
        <td>${product.product_naam}</td>
        <td><input type="number" value="1" onchange="updateTotalPrice()"></td>
        <td>${product.prijs}</td>
    `;
            productList.appendChild(row);

            updateTotalPrice();
        }

        function updateTotalPrice() {
            let totalQuantity = 0;
            let totalPrice = 0;

            const tableRows = document.querySelectorAll("#productList tr");
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

            document.getElementById("totaalaantal").value = totalQuantity;
            document.getElementById("totaalprijs").value = totalPrice.toFixed(2);
        }

    </script>
</body>

</html>