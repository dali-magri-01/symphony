<?php

namespace App\Entity;

use App\Repository\MonnaieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonnaieRepository::class)]
class Monnaie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'monnaies')]
    private ?Societe $societe = null;

    #[ORM\Column(length: 255)]
    private ?string $mon_code = null;

    #[ORM\Column(length: 255)]
    private ?string $mon_lib = null;

    #[ORM\OneToMany(mappedBy: 'monnaie', targetEntity: Journal::class)]
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

    public function getMonCode(): ?string
    {
        return $this->mon_code;
    }

    public function setMonCode(string $mon_code): static
    {
        $this->mon_code = $mon_code;

        return $this;
    }

    public function getMonLib(): ?string
    {
        return $this->mon_lib;
    }

    public function setMonLib(string $mon_lib): static
    {
        $this->mon_lib = $mon_lib;

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
            $journal->setMonnaie($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getMonnaie() === $this) {
                $journal->setMonnaie(null);
            }
        }

        return $this;
    }
}
