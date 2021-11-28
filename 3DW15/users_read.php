<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->getUsers();

?>
<html>
    <br/>
    <input type="button" onclick="location.href='index.php';" value="retour"/>
</html>