<?php

namespace App\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimeStampTrait
{


    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $createAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updateAt = null;



    public function getCreateAt(): ?\DateTime
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTime $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }


    public function setUpdateAt(?\DateTimeInterface $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }
    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->createAt = new \DateTime();
        $this->updateAt = new \DateTime();
    }


    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updateAt = new \DateTime();
    }

}