<?php

namespace App\Entities;

class Annoucement
{
    private $id;
    private $voiture_id;
    private $user_id;
    private $prix;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getVoiture_id(): string
    {
        return $this->voiture_id;
    }

    public function setVoiture_id(string $voiture_id): self
    {
        $this->voiture_id = $voiture_id;

        return $this;
    }

    public function getUser_id(): string
    {
        return $this->user_id;
    }

    public function setUser_id(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPrix(): string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
