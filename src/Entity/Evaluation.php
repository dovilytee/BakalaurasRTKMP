<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $placename = null;

    #[ORM\Column(length: 255)]
    private ?string $evaluation = null;

    #[ORM\Column(length: 255)]
    private ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getplacename(): ?string
    {
        return $this->placename;
    }

    public function setPlacename(string $placename): static
    {
        $this->placename = $placename;

        return $this;
    }
    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvalation(string $evaluation): static
    {
        $this->evaluation = $evaluation;

        return $this;
    }
    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}
