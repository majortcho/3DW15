<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = 'localhost';
    const PORT = '3308';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }
        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }
    /**
    * Create a car.
    */
    public function createCar(string $brand, string $model, string $color, int $nbrSlots): string
    {
        $carId = '';

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'INSERT INTO cars (brand, model, color, nbrSlots) VALUES (:brand, :model, :color, :nbrSlots)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $carId = $this->connection->lastInsertId();
        }

        return $carId;
    }

    /**
    * Update a car.
    */
    public function updateCar(string $id, string $brand, string $model, string $color, int $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, nbrSlots = :nbrSlots WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
    
    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all annoucements.
     */
    public function getAnnoucements(): array
    {
        $annoucements = [];

        $sql = 'SELECT * FROM annoucements';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annoucements = $results;
        }

        return $annoucements;
    }

    /**
    * Create an annoucement.
    */
    public function createAnnoucement(int $voiture_id, int $user_id, int $prix): string
    {
        $annoucementId = '';

        $data = [
            'voiture_id' => $voiture_id,
            'user_id' => $user_id,
            'prix' => $prix,
        ];
        $sql = 'INSERT INTO annoucements (voiture_id, user_id, prix) VALUES (:voiture_id, :user_id, :prix)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $annoucementId = $this->connection->lastInsertId();
        }

        return $annoucementId;
    }

    /**
    * Update an annoucement.
    */
    public function updateAnnoucement(string $id, string $voiture_id, string $user_id, string $prix): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'voiture_id' => $voiture_id,
            'user_id' => $user_id,
            'prix' => $prix,
        ];
        $sql = 'UPDATE annoucements SET voiture_id = :voiture_id, user_id = user_id, prix = :prix WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
    * Delete an annoucemement.
    */
    public function deleteAnnoucement(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM annoucements WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }

    /**
    * Create a reservation.
    */
    public function createReservation(int $voiture_id, int $user_id): string
    {
        $reservationId = '';

        $data = [
            'voiture_id' => $voiture_id,
            'user_id' => $user_id,
        ];
        $sql = 'INSERT INTO reservations (voiture_id, user_id) VALUES (:voiture_id, :user_id)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $reservationId = $this->connection->lastInsertId();
        }

        return $reservationId;
    }

    /**
    * Update a reservation.
    */
    public function updateReservation(string $id, string $voiture_id, string $user_id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'voiture_id' => $voiture_id,
            'user_id' => $user_id,
        ];
        $sql = 'UPDATE reservations SET voiture_id = :voiture_id, user_id = user_id WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
    * Delete a reservation.
    */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservations WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
}
