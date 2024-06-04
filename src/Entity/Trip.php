<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 4999)]
    private ?string $visit = null;

    #[ORM\Column(length: 4999)]
    private ?string $description = null;

    #[ORM\Column(length: 4999)]
    private ?string $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\ManyToOne(targetEntity: TripNumber::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $tripNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getVisit(): ?string
    {
        return $this->visit;
    }

    public function setVisit(string $visit): static
    {
        $this->visit = $visit;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }
    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }
    public function getTripNumber(): ?int
    {
        return $this->tripNumber;
    }

    public function setTripNumber(int $tripNumber): static
    {
        $this->tripNumber = $tripNumber;

        return $this;
    }
    #[ORM\ManyToOne(targetEntity: TripCity::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $tripCity;

    public function getTripCity()
    {
        return $this->tripCity;
    }

    public function setTripCity($tripCity)
    {
        $this->tripCity = $tripCity;
    }

}

