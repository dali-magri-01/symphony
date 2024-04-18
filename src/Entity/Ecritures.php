<?php

namespace App\Entity;

use App\Repository\EcrituresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcrituresRepository::class)]
class Ecritures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ecritures')]
    private ?PieceComptable $numpiece = null;


    #[ORM\ManyToOne(inversedBy: 'ecritures')]
    private ?Tiers $tier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255, nullable: true, options: ['default' => 'D'])]
    private ?string $sens =  'D';

    #[ORM\Column(nullable: true)]
    private ?float $montant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'ecritures')]
    private ?Compte $compte = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumpiece(): ?PieceComptable
    {
        return $this->numpiece;
    }

    public function setNumpiece(?PieceComptable $numpiece): static
    {
        $this->numpiece = $numpiece;

        return $this;
    }


    public function getTier(): ?Tiers
    {
        return $this->tier;
    }

    public function setTier(?Tiers $tier): static
    {
        $this->tier = $tier;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getSens(): ?string
    {
        return $this->sens;
    }

    public function setSens(?string $sens): static
    {
        $this->sens = $sens;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): static
    {
        $this->montant = $montant;

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

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): static
    {
        $this->compte = $compte;

        return $this;
    }


}
