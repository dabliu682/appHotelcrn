<?php

namespace App\Entity;

use App\Repository\CheckinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckinRepository::class)
 */
class Checkin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="checkins")
     */
    private $reserva;

    /**
     * @ORM\ManyToOne(targetEntity=Persons::class, inversedBy="checkins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\Column(type="date")
     */
    private $fechallegada;

    /**
     * @ORM\Column(type="time")
     */
    private $horallegada;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechasalida;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $horasalida;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $toalla;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aire;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cobija;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $control;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $llaves;

    /**
     * @ORM\ManyToOne(targetEntity=Turnos::class, inversedBy="checkins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turno;

    /**
     * @ORM\Column(type="integer")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=Movimientos::class, mappedBy="checkin")
     */
    private $movimientos;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class, inversedBy="checkins")
     */
    private $habitacion;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipocliente;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Movimientos::class, inversedBy="checkins")
     */
    private $movimiento;

    public function __construct()
    {
        $this->movimientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReserva(): ?booking
    {
        return $this->reserva;
    }

    public function setReserva(?booking $reserva): self
    {
        $this->reserva = $reserva;

        return $this;
    }

    public function getCliente(): ?persons
    {
        return $this->cliente;
    }

    public function setCliente(?persons $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getFechallegada(): ?\DateTimeInterface
    {
        return $this->fechallegada;
    }

    public function setFechallegada(\DateTimeInterface $fechallegada): self
    {
        $this->fechallegada = $fechallegada;

        return $this;
    }

    public function getHorallegada(): ?\DateTimeInterface
    {
        return $this->horallegada;
    }

    public function setHorallegada(\DateTimeInterface $horallegada): self
    {
        $this->horallegada = $horallegada;

        return $this;
    }

    public function getFechasalida(): ?\DateTimeInterface
    {
        return $this->fechasalida;
    }

    public function setFechasalida(\DateTimeInterface $fechasalida): self
    {
        $this->fechasalida = $fechasalida;

        return $this;
    }

    public function getHorasalida(): ?\DateTimeInterface
    {
        return $this->horasalida;
    }

    public function setHorasalida(\DateTimeInterface $horasalida): self
    {
        $this->horasalida = $horasalida;

        return $this;
    }

    public function isToalla(): ?bool
    {
        return $this->toalla;
    }

    public function setToalla(bool $toalla): self
    {
        $this->toalla = $toalla;

        return $this;
    }

    public function isAire(): ?bool
    {
        return $this->aire;
    }

    public function setAire(bool $aire): self
    {
        $this->aire = $aire;

        return $this;
    }

    public function isCobija(): ?bool
    {
        return $this->cobija;
    }

    public function setCobija(bool $cobija): self
    {
        $this->cobija = $cobija;

        return $this;
    }

    public function isControl(): ?bool
    {
        return $this->control;
    }

    public function setControl(bool $control): self
    {
        $this->control = $control;

        return $this;
    }

    public function isLlaves(): ?bool
    {
        return $this->llaves;
    }

    public function setLlaves(bool $llaves): self
    {
        $this->llaves = $llaves;

        return $this;
    }

    public function getTurno(): ?turnos
    {
        return $this->turno;
    }

    public function setTurno(?turnos $turno): self
    {
        $this->turno = $turno;

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
     * @return Collection<int, Movimientos>
     */
    public function getMovimientos(): Collection
    {
        return $this->movimientos;
    }

    public function addMovimiento(Movimientos $movimiento): self
    {
        if (!$this->movimientos->contains($movimiento)) {
            $this->movimientos[] = $movimiento;
            $movimiento->setCheckin($this);
        }

        return $this;
    }

    public function removeMovimiento(Movimientos $movimiento): self
    {
        if ($this->movimientos->removeElement($movimiento)) {
            // set the owning side to null (unless already changed)
            if ($movimiento->getCheckin() === $this) {
                $movimiento->setCheckin(null);
            }
        }

        return $this;
    }

    public function getHabitacion(): ?rooms
    {
        return $this->habitacion;
    }

    public function setHabitacion(?rooms $habitacion): self
    {
        $this->habitacion = $habitacion;

        return $this;
    }

    public function getTipocliente(): ?int
    {
        return $this->tipocliente;
    }

    public function setTipocliente(int $tipocliente): self
    {
        $this->tipocliente = $tipocliente;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getMovimiento(): ?Movimientos
    {
        return $this->movimiento;
    }

    public function setMovimiento(?Movimientos $movimiento): self
    {
        $this->movimiento = $movimiento;

        return $this;
    }
}
