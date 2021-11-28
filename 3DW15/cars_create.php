<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->createCar();

?>

<p>Création d'une voiture</p>
<form method="post" action="cars_create.php" name ="carCreateForm">
    <label for="brand">Marque :</label>
    <input type="text" name="brand">
    <br />
    <label for="model">Model :</label>
    <input type="text" name="model">
    <br />
    <label for="color">Couleur :</label>
    <input type="text" name="color">
    <br />
    <label for="nbrSlots">Nombre de place :</label>
    <input type="number" name="nbrSlots">
    <br />
    <input type="submit" value="Créer une voiture">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>