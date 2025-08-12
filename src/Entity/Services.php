<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Servicetype::class, inversedBy="services")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo;

    /**
     * @ORM\Column(type="text")
     */
    private $code;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="services")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usucrea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $typeroom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hours;

    /**
     * @ORM\OneToMany(targetEntity=Detallesmov::class, mappedBy="servicio")
     */
    private $detallesmovs;

    public function __construct()
    {
        $this->detallesmovs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?Servicetype
    {
        return $this->tipo;
    }

    public function setTipo(?Servicetype $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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

    public function getTyperoom(): ?int
    {
        return $this->typeroom;
    }

    public function setTyperoom(?int $typeroom): self
    {
        $this->typeroom = $typeroom;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(?int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * @return Collection<int, Detallesmov>
     */
    public function getDetallesmovs(): Collection
    {
        return $this->detallesmovs;
    }

    public function addDetallesmov(Detallesmov $detallesmov): self
    {
        if (!$this->detallesmovs->contains($detallesmov)) {
            $this->detallesmovs[] = $detallesmov;
            $detallesmov->setServicio($this);
        }

        return $this;
    }

    public function removeDetallesmov(Detallesmov $detallesmov): self
    {
        if ($this->detallesmovs->removeElement($detallesmov)) {
            // set the owning side to null (unless already changed)
            if ($detallesmov->getServicio() === $this) {
                $detallesmov->setServicio(null);
            }
        }

        return $this;
    }
}
