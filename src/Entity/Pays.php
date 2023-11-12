<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 10)]
    private ?string $alpha2 = null;

    #[ORM\Column(length: 10)]
    private ?string $alpha3 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nom_en_gb = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_fr_fr = null;

    #[ORM\OneToMany(mappedBy: 'pays_id', targetEntity: Societe::class)]
    private Collection $societes;

    public function __construct()
    {
        $this->societes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getAlpha2(): ?string
    {
        return $this->alpha2;
    }

    public function setAlpha2(string $alpha2): static
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    public function getAlpha3(): ?string
    {
        return $this->alpha3;
    }

    public function setAlpha3(string $alpha3): static
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    public function getNomEnGb(): ?string
    {
        return $this->nom_en_gb;
    }

    public function setNomEnGb(?string $nom_en_gb): static
    {
        $this->nom_en_gb = $nom_en_gb;

        return $this;
    }

    public function getNomFrFr(): ?string
    {
        return $this->nom_fr_fr;
    }

    public function setNomFrFr(string $nom_fr_fr): static
    {
        $this->nom_fr_fr = $nom_fr_fr;

        return $this;
    }

    /**
     * @return Collection<int, Societe>
     */
    public function getSocietes(): Collection
    {
        return $this->societes;
    }

    public function addSociete(Societe $societe): static
    {
        if (!$this->societes->contains($societe)) {
            $this->societes->add($societe);
            $societe->setPaysId($this);
        }

        return $this;
    }

    public function removeSociete(Societe $societe): static
    {
        if ($this->societes->removeElement($societe)) {
            // set the owning side to null (unless already changed)
            if ($societe->getPaysId() === $this) {
                $societe->setPaysId(null);
            }
        }

        return $this;
    }
}
