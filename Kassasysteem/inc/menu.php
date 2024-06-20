<?php
include "inc/database.php";

$autRole = isset($_SESSION['rol']) ? strtolower($_SESSION['rol']) : '';
$inlognaam = isset($_SESSION['gebruiker']) ? $_SESSION['gebruiker'] : '';

$sql = "SELECT rollen.rol_naam FROM medewerkers 
    INNER JOIN rollen ON medewerkers.rol_id = rollen.rol_id 
    WHERE medewerkers.medewerker_naam = ?";
    
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $inlognaam);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $autRole = strtolower($row["rol_naam"]);
}

$menu = '';

switch ($autRole) {
    case 'manager':
        $menu = '
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Kassa</a></li>
                    <li class="nav-item"><a class="nav-link" href="delete_order.php">Annuleren</a></li>
                    <li class="nav-item"><a class="nav-link" href="zoeken.php">Product zoeken</a></li>
                    <li class="nav-item"><a class="nav-link" href="uitloggen.php">Uitloggen</a></li>
                </ul>
            </nav>';
        break;
    case 'verkoper':
        $menu = '
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Kassa</a></li>
            <li class="nav-item"><a class="nav-link" href="delete_order.php">Annuleren</a></li>
            <li class="nav-item"><a class="nav-link" href="zoeken.php">Product zoeken</a></li>
            <li class="nav-item"><a class="nav-link" href="uitloggen.php">Uitloggen</a></li>
        </ul>
    </nav>';
        break;
    case 'magazijnmedewerker':
        $menu = '
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Kassa</a></li>
            <li class="nav-item"><a class="nav-link" href="delete_order.php">Annuleren</a></li>
            <li class="nav-item"><a class="nav-link" href="zoeken.php">Product zoeken</a></li>
            <li class="nav-item"><a class="nav-link" href="uitloggen.php">Uitloggen</a></li>
        </ul>
    </nav>';
        break;
    case 'kassamedewerker':
        $menu = '
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Kassa</a></li>
            <li class="nav-item"><a class="nav-link" href="delete_order.php">Annuleren</a></li>
            <li class="nav-item"><a class="nav-link" href="zoeken.php">Product zoeken</a></li>
            <li class="nav-item"><a class="nav-link" href="uitloggen.php">Uitloggen</a></li>
        </ul>
    </nav>';
        break;
    default:
        $menu = '
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Inloggen</a></li>
                </ul>
            </nav>';
}

echo $menu;

?>