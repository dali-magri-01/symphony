<?php

namespace App\Entity;

use App\Repository\TypeTiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeTiersRepository::class)]
class TypeTiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'typeTiers')]
    #[ORM\JoinColumn(unique: true, nullable: false)]
    private ?Societe $societe = null;

    #[ORM\Column(length: 250, unique: true, nullable: true)]
    private ?string $tt_code = null;

    #[ORM\Column(length: 250, nullable: false)]
    private ?string $tt_lib = null;

    #[ORM\OneToMany(mappedBy: 'cp_type_tiers', targetEntity: Compte::class)]
    private Collection $comptes;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTtCode(): ?string
    {
        return $this->tt_code;
    }

    public function setTtCode(?string $tt_code): static
    {
        $this->tt_code = $tt_code;

        return $this;
    }

    public function getTtLib(): ?string
    {
        return $this->tt_lib;
    }

    public function __toString(): string
    {
        return $this->tt_lib ?? '';
    }

    public function setTtLib(?string $tt_lib): static
    {
        $this->tt_lib = $tt_lib;

        return $this;
    }

    /**
     * @return Collection<int, Compte>
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): static
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes->add($compte);
            $compte->setCpTypeTiers($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): static
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getCpTypeTiers() === $this) {
                $compte->setCpTypeTiers(null);
            }
        }

        return $this;
    }
}
