<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->createReservation();

?>

<p>Création d'une reservation</p>
<form method="post" action="reservations_create.php" name ="reservationCreateForm">
    <label for="voiture_id">id de la voiture :</label>
    <input type="number" name="voiture_id">
    <br />
    <label for="user_id">id de l'utilisateur :</label>
    <input type="number" name="user_id">
    <br />
    <input type="submit" value="Créer la reservation">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>