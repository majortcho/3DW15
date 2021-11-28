<?php

namespace App\Services;

use App\Entities\Reservation;

class ReservationsService
{
    /**
     * Create or update an annoucement.
     */
    public function setReservation(?string $id, string $voiture_id, string $user_id): string
    {
        $reservationId='';
        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $reservationId = $dataBaseService->createReservation($voiture_id, $user_id);
        } else {
            $dataBaseService->updateReservation($id, $voiture_id, $user_id);
            $reservationId = $id;
        }
        return $reservationId;
    }

    /**
     * Return all annoucements.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $reservation->setVoiture_id($reservationDTO['voiture_id']);
                $reservation->setUser_id($reservationDTO['user_id']);
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }
    
    /**
     * Delete a reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
}
