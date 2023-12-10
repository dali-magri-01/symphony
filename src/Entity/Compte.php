<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    #[ORM\JoinColumn(unique: true,nullable: false)]
    private ?Societe $societe = null;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    private ?string $cp_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cp_lib = null;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeTiers $cp_type_tiers = null;

    #[ORM\Column(length: 1, nullable: true,  options: ['default' => 'B'])]
    private ?string $cp_sens = 'B';

    #[ORM\Column(length: 1, nullable: true, options: ['default' => 'O'])]
    private ?string $cp_actif = 'O';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cp_traduction = null;

    #[ORM\Column(length: 255, nullable: true, options: ['default' => 'N'])]
    private ?string $cp_analytique = 'N';

    #[ORM\OneToMany(mappedBy: 'compte', targetEntity: Journal::class)]
    private Collection $journals;

    public function __construct()
    {
        $this->journals = new ArrayCollection();
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

    public function getCpCode(): ?string
    {
        return $this->cp_code;
    }

    public function setCpCode(string $cp_code): static
    {
        $this->cp_code = $cp_code;

        return $this;
    }

    public function getCpLib(): ?string
    {
        return $this->cp_lib;
    }

    public function setCpLib(string $cp_lib): static
    {
        $this->cp_lib = $cp_lib;

        return $this;
    }

    public function getCpTypeTiers(): ?TypeTiers
    {
        return $this->cp_type_tiers;
    }

    public function setCpTypeTiers(?TypeTiers $cp_type_tiers): static
    {
        $this->cp_type_tiers = $cp_type_tiers;

        return $this;
    }

    public function getCpSens(): ?string
    {
        return $this->cp_sens;
    }

    public function setCpSens(string $cp_sens): static
    {
        $this->cp_sens = $cp_sens;

        return $this;
    }

    public function getCpActif(): ?string
    {
        return $this->cp_actif;
    }

    public function setCpActif(string $cp_actif): static
    {
        $this->cp_actif = $cp_actif;

        return $this;
    }

    public function getCpTraduction(): ?string
    {
        return $this->cp_traduction;
    }

    public function setCpTraduction(string $cp_traduction): static
    {
        $this->cp_traduction = $cp_traduction;

        return $this;
    }

    public function getCpAnalytique(): ?string
    {
        return $this->cp_analytique;
    }

    public function getConcatenatedLabel(): string
    {
        return $this->cp_lib . ' || ' . $this->cp_code;
    }

    public function setCpAnalytique(string $cp_analytique): static
    {
        $this->cp_analytique = $cp_analytique;

        return $this;
    }

    /**
     * @return Collection<int, Journal>
     */
    public function getJournals(): Collection
    {
        return $this->journals;
    }

    public function addJournal(Journal $journal): static
    {
        if (!$this->journals->contains($journal)) {
            $this->journals->add($journal);
            $journal->setCompte($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getCompte() === $this) {
                $journal->setCompte(null);
            }
        }

        return $this;
    }
}
