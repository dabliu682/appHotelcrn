<?php

namespace App\Entity;

use App\Repository\RoomsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomsRepository::class)
 */
class Rooms
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Floors::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $floor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bed_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aircond;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fan;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usucrea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    /**
     * @ORM\Column(type="integer")
     */
    private $typeroom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFloor(): ?Floors
    {
        return $this->floor;
    }

    public function setFloor(?Floors $floor): self
    {
        $this->floor = $floor;

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

    public function getBedNumber(): ?string
    {
        return $this->bed_number;
    }

    public function setBedNumber(?string $bed_number): self
    {
        $this->bed_number = $bed_number;

        return $this;
    }

    public function isAircond(): ?bool
    {
        return $this->aircond;
    }

    public function setAircond(bool $aircond): self
    {
        $this->aircond = $aircond;

        return $this;
    }

    public function isFan(): ?bool
    {
        return $this->fan;
    }

    public function setFan(bool $fan): self
    {
        $this->fan = $fan;

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

    public function setTyperoom(int $typeroom): self
    {
        $this->typeroom = $typeroom;

        return $this;
    }
}
