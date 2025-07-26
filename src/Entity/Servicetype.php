<?php

namespace App\Entity;

use App\Repository\ServicetypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicetypeRepository::class)
 */
class Servicetype
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Services::class, mappedBy="tipo")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="servicetypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usucrea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setTipo($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getTipo() === $this) {
                $service->setTipo(null);
            }
        }

        return $this;
    }

    public function getUsucrea(): ?User
    {
        return $this->usucrea;
    }

    public function setUsucrea(?User $usucrea): self
    {
        $this->usucrea = $usucrea;

        return $this;
    }

    public function getFechacrea(): ?\DateTimeInterface
    {
        return $this->fechacrea;
    }

    public function setFechacrea(\DateTimeInterface $fechacrea): self
    {
        $this->fechacrea = $fechacrea;

        return $this;
    }
}
