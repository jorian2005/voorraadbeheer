<head>
    <title>Kruitnagel - Login</title>
    <link rel="icon" href="Logo_K_trans_1.png">
</head>

<?php
include "inc/header.php";
?>

<style>
    .keyboard {
        margin-top: 20px;
    }

    .key {
        width: 60px;
        height: 60px;
        margin: 5px;
        font-size: 20px;
        text-align: center;
        line-height: 60px;
        background-color: #f0f0f0;
        cursor: pointer;
    }

    .key:hover {
        background-color: #ccc;
    }
</style>
<main class="main-content">
    <div id="login" class="d-flex flex-column align-items-center">
        <div class="container">
            <h1>Login</h1>
            <form action="authorisatie.php" method="post" class="frmlogin">
                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="password" name="pincode" id="pincode" class="form-control" required>
                </div>
                <input type="submit" value="Login" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="keyboard flex-column align-items-center">
        <div class="row">
            <div class="col-md-1">
                <div class="key" onclick="addKey(1)">1</div>
                <div class="key" onclick="addKey(4)">4</div>
                <div class="key" onclick="addKey(7)">7</div>
                <div class="key" onclick="addKey('Del')">Del</div>
            </div>
            <div class="col-md-1">
                <div class="key" onclick="addKey(2)">2</div>
                <div class="key" onclick="addKey(5)">5</div>
                <div class="key" onclick="addKey(8)">8</div>
                <div class="key" onclick="addKey(0)">0</div>
            </div>
            <div class="col-md-1">
                <div class="key" onclick="addKey(3)">3</div>
                <div class="key" onclick="addKey(6)">6</div>
                <div class="key" onclick="addKey(9)">9</div>
            </div>
        </div>
    </div>
</main>

<script>
    function addKey(key) {
        const pin = document.getElementById("pincode");

        if (key === 'Del') {
            pin.value = pin.value.slice(0, -1);
        } else {
            pin.value += key;
        }
    }
</script>