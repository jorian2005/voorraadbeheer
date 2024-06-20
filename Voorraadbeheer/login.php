<head>
    <title>Kruitnagel - Login</title>
</head>

<?php
include "inc/header.php";
?>

<main class="main-content">
    <div id="login" class="d-flex position-absolute top-50 start-50 translate-middle">
        <div>
            <h1>Login</h1>
            <form action="authorisatie.php" method="post" class="frmlogin">
                <label for="gebruikersnaam">Gebruiker:</label>
                <input type="text" name="gebruikersnaam" id="gebruikersnaam" required>
                <label for="wachtwoord">Wachtwoord:</label>
                <input type="password" name="wachtwoord" id="wachtwoord" required>
                <input type="submit" value="Login" name="submit">
            </form>
        </div>
    </div>
</main>