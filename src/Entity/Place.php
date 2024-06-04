<?php

namespace App\Entity;

use App\Repository\PlaceRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 4999)]
    private ?string $description = null;

    #[ORM\Column(length: 4999)]
    private ?string $working = null;

    #[ORM\Column(length: 4999)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: 'boolean')]
    private $isVisible;

    public function getIsVisible(): ?bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;

        return $this;
    }

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
    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

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
    public function getWorking(): ?string
    {
        return $this->working;
    }

    public function setWorking(string $working): static
    {
        $this->working = $working;

        return $this;
    }
    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
    #[ORM\ManyToOne(targetEntity: PlaceType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $placeType;

    public function getPlaceType()
    {
        return $this->placeType;
    }

    public function setPlaceType($placeType)
    {
        $this->placeType = $placeType;
    }
    #[ORM\ManyToOne(targetEntity: PlaceCity::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $placeCity;

    public function getPlaceCity()
    {
        return $this->placeCity;
    }

    public function setPlaceCity($placeCity)
    {
        $this->placeCity = $placeCity;
    }

    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'place', cascade: ['persist', 'remove'])]
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        $this->photos->add($photo);
        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getPlace() === $this) {
                $photo->setPlace(null);
            }
        }

        return $this;
    }
    public function setPhotos(?array $photos): self
    {
        $this->photos = $photos;

        return $this;
    }
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photoUrl;

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl(string $photoUrl): self
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }
}
