<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->deleteReservation();
?>

<p>Supression d'une annonce</p>
<form method="post" action="reservations_delete.php" name ="reservationDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une reservation">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>