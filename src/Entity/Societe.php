<?php

namespace App\Entity;
use App\Trait\TimeStampTrait;
use App\Repository\SocieteRepository;
use Doctrine\DBAL\Types\Types;
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


    #[ORM\Column(length: 40, nullable: true)]
    private ?string $rc = null;

    #[ORM\Column(nullable: true)]
    private ?bool $actif = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $imageblob = null;

    #[ORM\Column(nullable: true)]
    private ?int $CodePostal = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Filename = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $images = null;

    #[ORM\ManyToOne(inversedBy: 'societes')]
    private ?Pays $pays_id = null;

    #[ORM\ManyToOne(inversedBy: 'societes')]
    private ?Devise $Devise_id = null;


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

    public function getImageblob()
    {
        return $this->imageblob;
    }

    public function setImageblob($imageblob): static
    {
        $this->imageblob = $imageblob;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->CodePostal;
    }

    public function setCodePostal(?int $CodePostal): static
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->Filename;
    }

    public function setFilename(?string $Filename): static
    {
        $this->Filename = $Filename;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getPaysId(): ?Pays
    {
        return $this->pays_id;
    }

    public function setPaysId(?Pays $pays_id): static
    {
        $this->pays_id = $pays_id;

        return $this;
    }

    public function getDeviseId(): ?Devise
    {
        return $this->Devise_id;
    }

    public function setDeviseId(?Devise $Devise_id): static
    {
        $this->Devise_id = $Devise_id;

        return $this;
    }


}
