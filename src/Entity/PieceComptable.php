<?php

namespace App\Entity;

use App\Repository\PieceComptableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceComptableRepository::class)]
class PieceComptable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datepiece = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $libelle = null;



    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $tauxchange = null;

    #[ORM\OneToMany(mappedBy: 'numpiece', targetEntity: Ecritures::class, cascade: ['persist'])]
    private Collection $ecritures;


    #[ORM\ManyToOne(inversedBy: 'pieceComptables')]
    private ?Monnaie $monnaie = null;

    #[ORM\ManyToOne(inversedBy: 'pieceComptables')]
    private ?Journal $journal = null;

    #[ORM\ManyToOne(inversedBy: 'pieceComptables')]
    private ?Societe $societe = null;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $numero_pc = null;



    public function __construct()
    {
        $this->ecritures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatepiece(): ?\DateTimeInterface
    {
        return $this->datepiece;
    }

    public function setDatepiece(?\DateTimeInterface $datepiece): static
    {
        $this->datepiece = $datepiece;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }



    public function getTauxchange(): ?string
    {
        return $this->tauxchange;
    }

    public function setTauxchange(?string $tauxchange): static
    {
        $this->tauxchange = $tauxchange;

        return $this;
    }

    /**
     * @return Collection<int, Ecritures>
     */
    public function getEcritures(): Collection
    {
        return $this->ecritures;
    }

    public function addEcriture(Ecritures $ecriture): static
    {
        if (!$this->ecritures->contains($ecriture)) {
            $this->ecritures->add($ecriture);
            $ecriture->setNumpiece($this);
        }

        return $this;
    }

    public function removeEcriture(Ecritures $ecriture): static
    {
        if ($this->ecritures->removeElement($ecriture)) {
            // set the owning side to null (unless already changed)
            if ($ecriture->getNumpiece() === $this) {
                $ecriture->setNumpiece(null);
            }
        }

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

    public function getJournal(): ?Journal
    {
        return $this->journal;
    }

    public function setJournal(?Journal $journal): static
    {
        $this->journal = $journal;

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

    public function getNumeroPc(): ?string
    {
        return $this->numero_pc;
    }

    public function setNumeroPc(string $numero_pc): static
    {
        $this->numero_pc = $numero_pc;

        return $this;
    }


}
