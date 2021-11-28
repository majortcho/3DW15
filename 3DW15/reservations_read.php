<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->getReservations();

?>
<html>
    <br/>
    <input type="button" onclick="location.href='index.php';" value="retour"/>
</html>