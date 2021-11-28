<?php

use App\Controllers\AnnoucementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoucementsController();
echo $controller->getAnnoucements();

?>
<html>
    <br/>
    <input type="button" onclick="location.href='index.php';" value="retour"/>
</html>