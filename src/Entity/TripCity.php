<?php

namespace App\Entity;

use App\Repository\TripCityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripCityRepository::class)]
#[ORM\Table(name: 'trip_city')]
class TripCity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;
    #[ORM\Column(type: "string", length: 255)]
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }
    // Getter for name
    public function getName(): ?string
    {
        return $this->name;
    }

    // Setter for name
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
