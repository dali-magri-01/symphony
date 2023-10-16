<?php

namespace App\Entity;
use App\Trait\TimeStampTrait;
use App\Repository\SocieteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $libelle = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $matriculeFiscale = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $pays = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $rc = null;

    #[ORM\Column(nullable: true)]
    private ?bool $actif = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getmatriculeFiscale(): ?string
    {
        return $this->matriculeFiscale;
    }

    public function setmatriculeFiscale(?string $matriculeFiscale): static
    {
        $this->matriculeFiscale = $matriculeFiscale;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getRc(): ?string
    {
        return $this->rc;
    }

    public function setRc(?string $rc): static
    {
        $this->rc = $rc;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }


}
