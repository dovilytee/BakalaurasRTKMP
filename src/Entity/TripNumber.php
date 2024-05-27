<?php

namespace App\Entity;

use App\Repository\TripNumberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripNumberRepository::class)]
#[ORM\Table(name: 'trip_number')]
class TripNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $number;

    public function getId(): ?int
    {
        return $this->id;
    }
    // Getter for name
    public function getNumber(): ?string
    {
        return $this->number;
    }

    // Setter for name
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
