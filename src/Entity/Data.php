<?php

namespace App\Entity;

use App\Repository\DataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DataRepository::class)
 */
class Data
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $masquesAttente;

    /**
     * @ORM\Column(type="integer")
     */
    private $masquesTotal;

    /**
     * @ORM\Column(type="string", length=28, nullable=true)
     */
    private $dernierReleve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMasquesAttente(): ?int
    {
        return $this->masquesAttente;
    }

    public function setMasquesAttente(int $masquesAttente): self
    {
        $this->masquesAttente = $masquesAttente;

        return $this;
    }

    public function getMasquesTotal(): ?int
    {
        return $this->masquesTotal;
    }

    public function setMasquesTotal(int $masquesTotal): self
    {
        $this->masquesTotal = $masquesTotal;

        return $this;
    }

    public function getDernierReleve(): ?string
    {
        return $this->dernierReleve;
    }

    public function setDernierReleve(?string $dernierReleve): self
    {
        $this->dernierReleve = $dernierReleve;

        return $this;
    }
}
