<?php

namespace App\Entity;

use App\Repository\BonosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonosRepository::class)
 */
class Bonos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Turnos::class, inversedBy="bonos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turno;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bonos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usucrea;

    /**
     * @ORM\Column(type="integer")
     */
    private $estado;

    /**
     * @ORM\Column(type="text")
     */
    private $detalle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechacobro;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bonos_usucobro")
     */
    private $usucobro;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="beneficiario_bono")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

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

    public function getUsucrea(): ?User
    {
        return $this->usucrea;
    }

    public function setUsucrea(?User $usucrea): self
    {
        $this->usucrea = $usucrea;

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

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(string $detalle): self
    {
        $this->detalle = $detalle;

        return $this;
    }

    public function getFechacobro(): ?\DateTimeInterface
    {
        return $this->fechacobro;
    }

    public function setFechacobro(?\DateTimeInterface $fechacobro): self
    {
        $this->fechacobro = $fechacobro;

        return $this;
    }

    public function getUsucobro(): ?User
    {
        return $this->usucobro;
    }

    public function setUsucobro(?User $usucobro): self
    {
        $this->usucobro = $usucobro;

        return $this;
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
}
