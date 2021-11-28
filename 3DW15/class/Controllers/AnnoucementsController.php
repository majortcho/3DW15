<?php

namespace App\Controllers;

use App\Services\AnnoucementsService;

class AnnoucementsController
{
    /**
     * Return the html for the create action.
     */
    public function createAnnoucement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['voiture_id']) &&
            isset($_POST['user_id']) &&
            isset($_POST['prix'])) {
            // Create an annoucement :
            $annoucementsService = new AnnoucementsService();
            $annoucement = $annoucementsService->setAnnoucement(
                null,
                $_POST['voiture_id'],
                $_POST['usder_id'],
                $_POST['prix']
            );
            if (!empty($annoucement)) {
                $html = 'annonce créée avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }
        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAnnoucements(): string
    {
        $html = '';

        // Get all annoucements :
        $annoucementsService = new AnnoucementsService();
        $annoucements = $annoucementsService->getAnnoucements();

        // Get html :
        $html ='';
        foreach ($annoucements as $annoucement) {
            if (!empty($annoucements)) {
                $html .= $annoucement->getVoiture_id() . ' ' . $annoucement->getUser_id() . ' ' . $annoucement->getPrix() . ' ';
            }
        }
        return $html;
    }

    /**
     * Update an annoucement.
     */
    public function updateAnnoucement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['voiture_id']) &&
            isset($_POST['user_id']) &&
            isset($_POST['prix'])) {
            // Update the car :
            $annoucementsService = new AnnoucementsService();
            $isOk = $annoucementsService->setAnnoucement(
                $_POST['id'],
                $_POST['voiture_id'],
                $_POST['user_id'],
                $_POST['prix']
            );
            if ($isOk) {
                $html = 'annonce mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete an annoucement.
     */
    public function deleteAnnoucement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the car :
            $annoucementsService = new AnnoucementsService();
            $isOk = $annoucementsService->deleteAnnoucement($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}
