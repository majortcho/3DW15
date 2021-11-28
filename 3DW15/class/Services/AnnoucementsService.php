<?php

namespace App\Services;

use App\Entities\Annoucement;

class AnnoucementsService
{
    /**
     * Create or update an annoucement.
     */
    public function setAnnoucement(?string $id, string $voiture_id, string $user_id, string $prix): string
    {
        $annoucementId='';
        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $annoucementId = $dataBaseService->createAnnoucement($voiture_id, $user_id, $prix);
        } else {
            $dataBaseService->updateAnnoucement($id, $voiture_id, $user_id, $prix);
            $annoucementId = $id;
        }
        return $annoucementId;
    }

    /**
     * Return all annoucements.
     */
    public function getAnnoucements(): array
    {
        $annoucements = [];

        $dataBaseService = new DataBaseService();
        $annoucementsDTO = $dataBaseService->getAnnoucements();
        if (!empty($annoucementsDTO)) {
            foreach ($annoucementsDTO as $annoucementDTO) {
                $annoucement = new Annoucement();
                $annoucement->setId($annoucementDTO['id']);
                $annoucement->setVoiture_id($annoucementDTO['voiture_id']);
                $annoucement->setUser_id($annoucementDTO['user_id']);
                $annoucement->setPrix($annoucementDTO['prix']);
                $annoucements[] = $annoucement;
            }
        }

        return $annoucements;
    }
    
    /**
     * Delete an annoucements.
     */
    public function deleteAnnoucement(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnoucement($id);

        return $isOk;
    }
}
