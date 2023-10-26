<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatistiqueRepository::class)]
class Statistique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $victoire = null;

    #[ORM\Column]
    private ?int $defaite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVictoire(): ?int
    {
        return $this->victoire;
    }

    public function setVictoire(int $victoire): static
    {
        $this->victoire = $victoire;

        return $this;
    }

    public function getDefaite(): ?int
    {
        return $this->defaite;
    }

    public function setDefaite(int $defaite): static
    {
        $this->defaite = $defaite;

        return $this;
    }
}
