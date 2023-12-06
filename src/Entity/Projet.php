<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?Societe $societe = null;

    #[ORM\Column(length: 20)]
    private ?string $pr_code = null;

    #[ORM\Column(length: 255)]
    private ?string $pr_lib = null;

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

    public function getPrCode(): ?string
    {
        return $this->pr_code;
    }

    public function setPrCode(string $pr_code): static
    {
        $this->pr_code = $pr_code;

        return $this;
    }

    public function getPrLib(): ?string
    {
        return $this->pr_lib;
    }

    public function setPrLib(string $pr_lib): static
    {
        $this->pr_lib = $pr_lib;

        return $this;
    }
}
