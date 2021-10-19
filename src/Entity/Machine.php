<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $structureUuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gatewayUuid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sampling;

    /**
     * @ORM\OneToMany(targetEntity=Releve::class, mappedBy="machine")
     */
    private $releve;

    public function __construct()
    {
        $this->releve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getStructureUuid(): ?string
    {
        return $this->structureUuid;
    }

    public function setStructureUuid(string $structureUuid): self
    {
        $this->structureUuid = $structureUuid;

        return $this;
    }

    public function getGatewayUuid(): ?string
    {
        return $this->gatewayUuid;
    }

    public function setGatewayUuid(string $gatewayUuid): self
    {
        $this->gatewayUuid = $gatewayUuid;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSampling(): ?string
    {
        return $this->sampling;
    }

    public function setSampling(string $sampling): self
    {
        $this->sampling = $sampling;

        return $this;
    }

    /**
     * @return Collection|Releve[]
     */
    public function getReleve(): Collection
    {
        return $this->releve;
    }

    public function addReleve(Releve $releve): self
    {
        if (!$this->releve->contains($releve)) {
            $this->releve[] = $releve;
            $releve->setMachine($this);
        }

        return $this;
    }

    public function removeReleve(Releve $releve): self
    {
        if ($this->releve->removeElement($releve)) {
            // set the owning side to null (unless already changed)
            if ($releve->getMachine() === $this) {
                $releve->setMachine(null);
            }
        }

        return $this;
    }
}
