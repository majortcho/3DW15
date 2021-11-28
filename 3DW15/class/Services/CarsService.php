<?php

namespace App\Services;

use App\Entities\Car;

class CarsService
{
    /**
     * Create or update an user.
     */
    public function setCar(?string $id, string $brand, string $model, string $color, int $nbrSlots): string
    {
        $carId='';
        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $carId = $dataBaseService->createCar($brand, $model, $color, $nbrSlots);
        } else {
            $dataBaseService->updateCar($id, $brand, $model, $color, $nbrSlots);
            $carId = $id;
        }
        return $carId;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $dataBaseService = new DataBaseService();
        $carsDTO = $dataBaseService->getCars();
        if (!empty($carsDTO)) {
            foreach ($carsDTO as $carDTO) {
                $car = new Car();
                $car->setId($carDTO['id']);
                $car->setBrand($carDTO['brand']);
                $car->setModel($carDTO['model']);
                $car->setColor($carDTO['color']);
                $car->setNbrSlots($carDTO['nbrSlots']);
                $cars[] = $car;
            }
        }

        return $cars;
    }
    
    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCar($id);

        return $isOk;
    }
}
