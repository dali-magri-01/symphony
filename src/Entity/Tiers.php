<?php

namespace App\Entity;

use App\Repository\TiersRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: TiersRepository::class)]
class Tiers
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $tr_code = null;

    #[ORM\Column(length: 20)]
    private ?string $tr_lib = null;

    #[ORM\ManyToOne(inversedBy: 'tiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeTiers $tr_type_tiers = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tr_adresse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $tr_type_ident = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tr_ident = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tr_activite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tr_email = null;

    #[ORM\ManyToOne(inversedBy: 'tiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrCode(): ?string
    {
        return $this->tr_code;
    }

    public function setTrCode(string $tr_code): static
    {
        $this->tr_code = $tr_code;

        return $this;
    }

    public function getTrLib(): ?string
    {
        return $this->tr_lib;
    }

    public function setTrLib(string $tr_lib): static
    {
        $this->tr_lib = $tr_lib;

        return $this;
    }

    public function getTrTypeTiers(): ?TypeTiers
    {
        return $this->tr_type_tiers;
    }

    public function setTrTypeTiers(?TypeTiers $tr_type_tiers): static
    {
        $this->tr_type_tiers = $tr_type_tiers;

        return $this;
    }

    public function getTrAdresse(): ?string
    {
        return $this->tr_adresse;
    }

    public function setTrAdresse(?string $tr_adresse): static
    {
        $this->tr_adresse = $tr_adresse;

        return $this;
    }

    public function getTrTypeIdent(): ?string
    {
        return $this->tr_type_ident;
    }

    public function setTrTypeIdent(?string $tr_type_ident): static
    {
        $this->tr_type_ident = $tr_type_ident;

        return $this;
    }

    public function getTrIdent(): ?string
    {
        return $this->tr_ident;
    }

    public function setTrIdent(?string $tr_ident): static
    {
        $this->tr_ident = $tr_ident;

        return $this;
    }

    public function getTrActivite(): ?string
    {
        return $this->tr_activite;
    }

    public function setTrActivite(?string $tr_activite): static
    {
        $this->tr_activite = $tr_activite;

        return $this;
    }

    public function getTrEmail(): ?string
    {
        return $this->tr_email;
    }

    public function setTrEmail(?string $tr_email): static
    {
        $this->tr_email = $tr_email;

        return $this;
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
}
