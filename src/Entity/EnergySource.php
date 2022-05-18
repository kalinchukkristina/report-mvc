<?php

namespace App\Entity;

use App\Repository\EnergySourceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnergySourceRepository::class)]
class EnergySource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $water;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $wind;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $heat;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sun;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $total;

    #[ORM\Column(type: 'integer')]
    private $year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getWater(): ?string
    {
        return $this->water;
    }

    public function setWater(?string $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getWind(): ?string
    {
        return $this->wind;
    }

    public function setWind(?string $wind): self
    {
        $this->wind = $wind;

        return $this;
    }

    public function getHeat(): ?string
    {
        return $this->heat;
    }

    public function setHeat(?string $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getSun(): ?string
    {
        return $this->sun;
    }

    public function setSun(?string $sun): self
    {
        $this->sun = $sun;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }
}
