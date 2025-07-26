<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Persons::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\Column(type="date")
     */
    private $fechallegada;

    /**
     * @ORM\Column(type="time")
     */
    private $horallegada;

    /**
     * @ORM\Column(type="integer")
     */
    private $aire;

    /**
     * @ORM\Column(type="integer")
     */
    private $canthabitaciones;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    /**
     * @ORM\ManyToOne(targetEntity=Turnos::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?Persons
    {
        return $this->person;
    }

    public function setPerson(?Persons $person): self
    {
        $this->person = $person;

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

    public function getAire(): ?int
    {
        return $this->aire;
    }

    public function setAire(int $aire): self
    {
        $this->aire = $aire;

        return $this;
    }

    public function getCanthabitaciones(): ?int
    {
        return $this->canthabitaciones;
    }

    public function setCanthabitaciones(int $canthabitaciones): self
    {
        $this->canthabitaciones = $canthabitaciones;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

    public function getTurno(): ?Turnos
    {
        return $this->turno;
    }

    public function setTurno(?Turnos $turno): self
    {
        $this->turno = $turno;

        return $this;
    }
}
