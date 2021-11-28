<?php

use App\Controllers\AnnoucementsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoucementsController();
echo $controller->createAnnoucement();

?>

<p>Création d'une annonce</p>
<form method="post" action="annoucements_create.php" name ="annoucementCreateForm">
    <label for="voiture_id">id de la voiture :</label>
    <input type="number" name="voiture_id">
    <br />
    <label for="user_id">id de l'utilisateur :</label>
    <input type="number" name="user_id">
    <br />
    <label for="prix">prix de la location de la voiture :</label>
    <input type="number" name="prix">
    <br />
    <input type="submit" value="Créer l'annonce">
</form>

<input type="button" onclick="location.href='index.php';" value="retour"/>