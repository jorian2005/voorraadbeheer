<head>
    <title>Kruitnagel - Nieuwe Levering</title>
</head>

<?php include "inc/header.php"; ?>

<h1>CSV Bestand Uploaden</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Selecteer CSV Bestand:</label>
    <input type="file" name="file" id="file" accept=".csv" required><br><br>

    <label for="title">Titel voor het Bestand:</label>
    <input type="text" name="title" id="title" required><br><br>

    <input type="submit" name="submit" value="Uploaden">
</form>