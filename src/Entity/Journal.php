<?php

namespace App\Entity;

use App\Repository\JournalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JournalRepository::class)]
class Journal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    private ?Societe $societe = null;

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

    public function getJlCode(): ?string
    {
        return $this->jl_code;
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
}
