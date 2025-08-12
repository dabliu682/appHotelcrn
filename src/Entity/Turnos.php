<?php

namespace App\Entity;

use App\Repository\TurnosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TurnosRepository::class)
 */
class Turnos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="turnos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startdate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $enddate;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="turno")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity=Checkin::class, mappedBy="turno")
     */
    private $checkins;

    /**
     * @ORM\OneToMany(targetEntity=Detallesmov::class, mappedBy="turno")
     */
    private $detallesmovs;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->checkins = new ArrayCollection();
        $this->detallesmovs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(?\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

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

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setTurno($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getTurno() === $this) {
                $booking->setTurno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Checkin>
     */
    public function getCheckins(): Collection
    {
        return $this->checkins;
    }

    public function addCheckin(Checkin $checkin): self
    {
        if (!$this->checkins->contains($checkin)) {
            $this->checkins[] = $checkin;
            $checkin->setTurno($this);
        }

        return $this;
    }

    public function removeCheckin(Checkin $checkin): self
    {
        if ($this->checkins->removeElement($checkin)) {
            // set the owning side to null (unless already changed)
            if ($checkin->getTurno() === $this) {
                $checkin->setTurno(null);
            }
        }

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
            $detallesmov->setTurno($this);
        }

        return $this;
    }

    public function removeDetallesmov(Detallesmov $detallesmov): self
    {
        if ($this->detallesmovs->removeElement($detallesmov)) {
            // set the owning side to null (unless already changed)
            if ($detallesmov->getTurno() === $this) {
                $detallesmov->setTurno(null);
            }
        }

        return $this;
    }
}
