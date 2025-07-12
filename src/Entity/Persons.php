<?php

namespace App\Entity;

use App\Repository\PersonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonsRepository::class)
 */
class Persons
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Documents::class, inversedBy="persons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $document;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $document_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cellphone;

    /**
     * @ORM\ManyToOne(targetEntity=Companys::class, inversedBy="persons")
     */
    private $compania;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="persons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usucrea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $number_bus;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="person")
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocument(): ?documents
    {
        return $this->document;
    }

    public function setDocument(?documents $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getDocumentNumber(): ?string
    {
        return $this->document_number;
    }

    public function setDocumentNumber(?string $document_number): self
    {
        $this->document_number = $document_number;

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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    public function setCellphone(?string $cellphone): self
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    public function getCompania(): ?companys
    {
        return $this->compania;
    }

    public function setCompania(?companys $compania): self
    {
        $this->compania = $compania;

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

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(?string $placa): self
    {
        $this->placa = $placa;

        return $this;
    }

    public function getNumberBus(): ?string
    {
        return $this->number_bus;
    }

    public function setNumberBus(?string $number_bus): self
    {
        $this->number_bus = $number_bus;

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
            $booking->setPerson($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getPerson() === $this) {
                $booking->setPerson(null);
            }
        }

        return $this;
    }
}
