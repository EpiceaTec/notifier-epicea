<?php

namespace App\Entity;

use App\Repository\MachineStateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineStateRepository::class)
 */
class MachineState
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
    private $stateCode;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $dateReleve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStateCode(): ?int
    {
        return $this->stateCode;
    }

    public function setStateCode(int $stateCode): self
    {
        $this->stateCode = $stateCode;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDateReleve(): ?string
    {
        return $this->dateReleve;
    }

    public function setDateReleve(string $dateReleve): self
    {
        $this->dateReleve = $dateReleve;

        return $this;
    }
}
