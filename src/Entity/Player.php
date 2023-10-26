<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $nomClub = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAdhesion = null;

    #[ORM\ManyToMany(targetEntity: Clubs::class, inversedBy: 'players')]
    private Collection $clubs;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Contrat::class)]
    private Collection $Contrat;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Statistique $Statistique = null;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
        $this->Contrat = new ArrayCollection();
    }

    public function __toString(){
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNomClub(): ?string
    {
        return $this->nomClub;
    }

    public function setNomClub(string $nomClub): static
    {
        $this->nomClub = $nomClub;

        return $this;
    }

    public function getDateAdhesion(): ?\DateTimeInterface
    {
        return $this->dateAdhesion;
    }

    public function setDateAdhesion(\DateTimeInterface $dateAdhesion): static
    {
        $this->dateAdhesion = $dateAdhesion;

        return $this;
    }

    /**
     * @return Collection<int, Clubs>
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Clubs $club): static
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs->add($club);
        }

        return $this;
    }

    public function removeClub(Clubs $club): static
    {
        $this->clubs->removeElement($club);

        return $this;
    }

    /**
     * @return Collection<int, Contrat>
     */
    public function getContrat(): Collection
    {
        return $this->Contrat;
    }

    public function addContrat(Contrat $contrat): static
    {
        if (!$this->Contrat->contains($contrat)) {
            $this->Contrat->add($contrat);
            $contrat->setPlayer($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): static
    {
        if ($this->Contrat->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getPlayer() === $this) {
                $contrat->setPlayer(null);
            }
        }

        return $this;
    }

    public function getStatistique(): ?Statistique
    {
        return $this->Statistique;
    }

    public function setStatistique(Statistique $Statistique): static
    {
        $this->Statistique = $Statistique;

        return $this;
    }
}
