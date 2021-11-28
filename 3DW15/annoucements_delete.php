<?php

use App\Controllers\AnnoucementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoucementsController();
echo $controller->deleteAnnoucement();
?>

<p>Supression d'une annonce</p>
<form method="post" action="annoucements_delete.php" name ="annoucementDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonnce">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>