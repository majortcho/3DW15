<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->getcars();

?>
<html>
    <br/>
    <input type="button" onclick="location.href='index.php';" value="retour"/>
</html>