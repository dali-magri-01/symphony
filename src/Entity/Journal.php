<?php

namespace App\Entity;

use App\Repository\JournalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JournalRepository::class)]
class Journal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 20)]
    private ?string $jl_code = null;

    #[ORM\Column(length: 255)]
    private ?string $jl_lib = null;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    private ?Monnaie $monnaie = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $mois_exer = null;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    private ?Compte $compte = null;



    #[ORM\ManyToOne(inversedBy: 'journals')]
    private ?Societe $societe = null;

    #[ORM\OneToMany(mappedBy: 'journal', targetEntity: PieceComptable::class)]
    private Collection $pieceComptables;

    public function __construct()
    {
        $this->pieceComptables = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getJlCode(): ?string
    {
        return $this->jl_code ;
    }

    public function getJournal(): ?string
    {
        return $this->jl_code  .' || ' . $this->jl_lib;
    }

    public function setJlCode(string $jl_code): static
    {
        $this->jl_code = $jl_code;

        return $this;
    }

    public function getJlLib(): ?string
    {
        return $this->jl_lib;
    }

    public function setJlLib(string $jl_lib): static
    {
        $this->jl_lib = $jl_lib;

        return $this;
    }

    public function getMonnaie(): ?Monnaie
    {
        return $this->monnaie;
    }

    public function setMonnaie(?Monnaie $monnaie): static
    {
        $this->monnaie = $monnaie;

        return $this;
    }

    public function getMoisExer(): ?string
    {
        return $this->mois_exer;
    }

    public function setMoisExer(?string $mois_exer): static
    {
        $this->mois_exer = $mois_exer;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): static
    {
        $this->compte = $compte;

        return $this;
    }


    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * @return Collection<int, PieceComptable>
     */
    public function getPieceComptables(): Collection
    {
        return $this->pieceComptables;
    }

    public function addPieceComptable(PieceComptable $pieceComptable): static
    {
        if (!$this->pieceComptables->contains($pieceComptable)) {
            $this->pieceComptables->add($pieceComptable);
            $pieceComptable->setJournal($this);
        }

        return $this;
    }

    public function removePieceComptable(PieceComptable $pieceComptable): static
    {
        if ($this->pieceComptables->removeElement($pieceComptable)) {
            // set the owning side to null (unless already changed)
            if ($pieceComptable->getJournal() === $this) {
                $pieceComptable->setJournal(null);
            }
        }

        return $this;
    }


}
