<?php

namespace App\Entity;

use App\Repository\DeviseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviseRepository::class)]
class Devise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'Devise_id', targetEntity: Societe::class)]
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

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
            $societe->setDeviseId($this);
        }

        return $this;
    }

    public function removeSociete(Societe $societe): static
    {
        if ($this->societes->removeElement($societe)) {
            // set the owning side to null (unless already changed)
            if ($societe->getDeviseId() === $this) {
                $societe->setDeviseId(null);
            }
        }

        return $this;
    }
}
