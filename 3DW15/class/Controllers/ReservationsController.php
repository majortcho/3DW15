<?php

namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['voiture_id']) &&
            isset($_POST['user_id'])) {
            // Create a reservation :
            $reservationsService = new ReservationsService();
            $reservation = $reservationsService->setReservation(
                null,
                $_POST['voiture_id'],
                $_POST['usder_id']
            );
            if (!empty($reservation)) {
                $html = 'reservation créée avec succès.';
            } else {
                $html = 'Erreur lors de la création de la reservation.';
            }
        }
        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getReservations(): string
    {
        $html = '';

        // Get all reservations :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        $html ='';
        foreach ($reservations as $reservation) {
            if (!empty($reservations)) {
                $html .= $reservation->getVoiture_id() . ' ' . $reservation->getUser_id() . ' ';
            }
        }
        return $html;
    }

    /**
     * Update a reservation.
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['voiture_id']) &&
            isset($_POST['user_id'])) {
            // Update the reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['id'],
                $_POST['voiture_id'],
                $_POST['user_id']
            );
            if ($isOk) {
                $html = 'reservation mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la reservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['id']);
            if ($isOk) {
                $html = 'Reservation supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la reservation.';
            }
        }

        return $html;
    }
}
