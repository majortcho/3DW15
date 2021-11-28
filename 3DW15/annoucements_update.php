<?php

use App\Controllers\AnnoucementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoucementsController();
echo $controller->updateAnnoucement();
?>

<p>Mise à jour d'une annonce</p>
<form method="post" action="annoucements_update.php" name ="annoucementUpdateForm">
    <label for="id">Id :</label>
    <input type="number" name="id">
    <br />
    <label for="voiture_id">Voiture id :</label>
    <input type="number" name="voiture_id">
    <br />
    <label for="user_id">Utilisateur id :</label>
    <input type="number" name="user_id">
    <br />
    <label for="prix">Prix :</label>
    <input type="text" name="prix">
    <br />
    <input type="submit" value="Modifier l\'annonce">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>