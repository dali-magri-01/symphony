<?php

namespace App\Entity;

use App\Repository\TypeTiersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeTiersRepository::class)]
class TypeTiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'typeTiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $tt_code = null;

    #[ORM\Column(length: 20, nullable: false, unique:true)]
    private ?string $tt_lib = null;

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

    public function setTtLib(?string $tt_lib): static
    {
        $this->tt_lib = $tt_lib;

        return $this;
    }
}
