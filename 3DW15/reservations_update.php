<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->updateReservation();
?>

<p>Mise à jour d'une annonce</p>
<form method="post" action="reservations_update.php" name ="reservationUpdateForm">
    <label for="id">Id :</label>
    <input type="number" name="id">
    <br />
    <label for="voiture_id">Voiture id :</label>
    <input type="number" name="voiture_id">
    <br />
    <label for="user_id">Utilisateur id :</label>
    <input type="number" name="user_id">
    <br />
    <input type="submit" value="Modifier la reservation">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>