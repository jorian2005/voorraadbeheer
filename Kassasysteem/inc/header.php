<?php
session_start();
// controle of er is ingelogd
$file = str_replace(dirname($_SERVER['PHP_SELF']) . '/', '', $_SERVER['PHP_SELF']);
$ingelogd = isset($_SESSION['ingelogd']) ? $_SESSION['ingelogd'] : false;

if (($file != 'login.php') and ($file != 'authorisatie.php')) {
    if (!$ingelogd) {
        header('refresh:0;url=login.php');
        exit;
    }
    ;
}
;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="icon" href="Logo_K_trans_1.png">
</head>

<body>
    <div class="container">
        <?php
        include "inc/menu.php";
        ?>