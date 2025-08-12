<?php

namespace App\Entity;

use App\Repository\MovimientosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovimientosRepository::class)
 */
class Movimientos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=checkin::class, inversedBy="movimientos")
     */
    private $checkin;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipo;

    /**
     * @ORM\Column(type="integer")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=Detallesmov::class, mappedBy="mov")
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

    public function getCheckin(): ?checkin
    {
        return $this->checkin;
    }

    public function setCheckin(?checkin $checkin): self
    {
        $this->checkin = $checkin;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(int $estado): self
    {
        $this->estado = $estado;

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
            $detallesmov->setMov($this);
        }

        return $this;
    }

    public function removeDetallesmov(Detallesmov $detallesmov): self
    {
        if ($this->detallesmovs->removeElement($detallesmov)) {
            // set the owning side to null (unless already changed)
            if ($detallesmov->getMov() === $this) {
                $detallesmov->setMov(null);
            }
        }

        return $this;
    }
}
