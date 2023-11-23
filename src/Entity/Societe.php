<?php

namespace App\Entity;
use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $matriculeFiscale = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $rc = null;

    #[ORM\Column(nullable: true)]
    private ?bool $actif = null;

    #[ORM\Column(nullable: true)]
    private ?int $codePostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoFilename = null;

    #[ORM\ManyToOne(inversedBy: 'societes')]
    private ?Pays $pays = null;

    #[ORM\ManyToOne(inversedBy: 'societes')]
    private ?Devise $devise = null;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: TypeTiers::class)]
    private Collection $typeTiers;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: Compte::class)]
    private Collection $comptes;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: Tiers::class)]
    private Collection $tiers;

    public function __construct()
    {
        $this->typeTiers = new ArrayCollection();
        $this->comptes = new ArrayCollection();
        $this->tiers = new ArrayCollection();
    }


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

    /**
     * @return int|null
     */
    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    /**
     * @param int|null $codePostal
     */
    public function setCodePostal(?int $codePostal): void
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return string|null
     */
    public function getLogoFilename(): ?string
    {
        return $this->logoFilename;
    }

    /**
     * @param string|null $logoFilename
     */
    public function setLogoFilename(?string $logoFilename): void
    {
        $this->logoFilename = $logoFilename;
    }

    /**
     * @return Pays|null
     */
    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    /**
     * @param Pays|null $pays
     */
    public function setPays(?Pays $pays): void
    {
        $this->pays = $pays;
    }

    /**
     * @return Devise|null
     */
    public function getDevise(): ?Devise
    {
        return $this->devise;
    }

    /**
     * @param Devise|null $devise
     */
    public function setDevise(?Devise $devise): void
    {
        $this->devise = $devise;
    }

    /**
     * @return Collection<int, TypeTiers>
     */
    public function getTypeTiers(): Collection
    {
        return $this->typeTiers;
    }

    public function addTypeTier(TypeTiers $typeTier): static
    {
        if (!$this->typeTiers->contains($typeTier)) {
            $this->typeTiers->add($typeTier);
            $typeTier->setSociete($this);
        }

        return $this;
    }

    public function removeTypeTier(TypeTiers $typeTier): static
    {
        if ($this->typeTiers->removeElement($typeTier)) {
            // set the owning side to null (unless already changed)
            if ($typeTier->getSociete() === $this) {
                $typeTier->setSociete(null);
            }
        }

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
            $compte->setSociete($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): static
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getSociete() === $this) {
                $compte->setSociete(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tiers>
     */
    public function getTiers(): Collection
    {
        return $this->tiers;
    }

    public function addTier(Tiers $tier): static
    {
        if (!$this->tiers->contains($tier)) {
            $this->tiers->add($tier);
            $tier->setSociete($this);
        }

        return $this;
    }

    public function removeTier(Tiers $tier): static
    {
        if ($this->tiers->removeElement($tier)) {
            // set the owning side to null (unless already changed)
            if ($tier->getSociete() === $this) {
                $tier->setSociete(null);
            }
        }

        return $this;
    }
}
