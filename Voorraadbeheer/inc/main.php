<?php

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
$rol = $_SESSION['rol'];

$main = '';

switch ($autRole) {
    case 'manager':
        $main = '
            <div class="btn-group" style="margin-bottom: 20px;">
                <div class="btn-wrapper">
                    <a href="index.php" class="btn btn-primary">Home</a>
                </div>
                <div class="btn-wrapper">
                    <a href="medewerker.php" class="btn btn-primary">Medewerkers</a>
                </div>
                <div class="btn-wrapper">
                    <a href="dagrapport.php" class="btn btn-primary">Dagrapport</a>
                </div>
                <div class="btn-wrapper">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Voorraad
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="levering.php">Nieuwe Levering</a>
                        </div>
                    </div>
                </div>
                <div class="btn-wrapper">
                    <a href="#" class="btn btn-primary">Contact</a>
                </div>
                <div class="btn-wrapper">
                    <a href="uitloggen.php" class="btn btn-primary">Uitloggen</a>
                </div>
            </div>';
        break;
    case 'verkoper':
        $main = '
            <div class="btn-group" style="margin-bottom: 20px;">
                <div class="btn-wrapper">
                    <a href="#" class="btn btn-primary">Home</a>
                </div>
                <div class="btn-wrapper">
                    <a href="#" class="btn btn-primary">Voorraad</a>
                </div>
                <div class="btn-wrapper">
                    <a href="uitloggen.php" class="btn btn-primary">Uitloggen</a>
                </div>
            </div>';
        break;
    case 'magazijnmedewerker':
        $main = '
            <div class="btn-group" style="margin-bottom: 20px;">
                <div class="btn-wrapper">
                    <a href="#" class="btn btn-primary">Home</a>
                </div>
                <div class="btn-wrapper">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Voorraad
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="levering.php">Nieuwe Levering</a>
                        </div>
                    </div>
                </div>
                <div class="btn-wrapper">
                    <a href="uitloggen.php" class="btn btn-primary">Uitloggen</a>
                </div>
            </div>';
        break;
    case 'kassamedewerker':
        $main = '
            <div class="btn-group" style="margin-bottom: 20px;">
                <div class="btn-wrapper">
                    <a href="#" class="btn btn-primary">Home</a>
                </div>
                <div class="btn-wrapper">
                    <a href="uitloggen.php" class="btn btn-primary">Uitloggen</a>
                </div>
            </div>';
        break;
    default:
        $main = '
            <div class="btn-group" style="margin-bottom: 20px;">
                <div class="btn-wrapper">
                    <a href="#" class="btn btn-primary">Home</a>
                </div>
                <div class="btn-wrapper">
                    <a href="login.php" class="btn btn-primary">Inloggen</a>
                </div>
            </div>';
}
echo $main;
?>