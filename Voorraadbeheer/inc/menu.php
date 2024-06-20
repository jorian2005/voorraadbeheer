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

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';


switch ($autRole) {
    case 'manager':
        $menu = '
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="medewerker.php">Medewerkers</a></li>
                    <li><a href="dagrapport.php">Dagrapport</a></li>
                    <li><a href="Voorraad.php" class="dropbtn">Voorraad</a> 
                        <ul>
                            <li><a href="levering.php">Nieuwe Levering</a></li>
                        </ul></li>
                    <li><a href="categorie.php">Categorieën</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                    <li style="float: right;">Rol: ' . $rol . '</li>
                </ul>
            </nav>';
        break;
    case 'verkoper':
        $menu = '
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Voorraad</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                    <li style="float: right;">Rol: ' . $rol . '</li>
                </ul>
            </nav>';
        break;
    case 'magazijnmedewerker':
        $menu = '
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="Voorraad.php" class="dropbtn">Voorraad</a> 
                        <ul>
                            <li><a href="levering.php">Nieuwe Levering</a></li>
                        </ul></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                    <li style="float: right;">Rol: ' . $rol . '</li>
                </ul>
            </nav>';
        break;
    case 'kassamedewerker':
        $menu = '
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="uitloggen.php">Uitloggen</a></li>
                    <li style="float: right;">Rol: ' . $rol . '</li>
                </ul>
            </nav>';
        break;
    default:
        $menu = '
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="login.php">Inloggen</a></li>
                </ul>
            </nav>';
}

echo $menu;

?>