<?php

namespace App\Entity;

use App\Repository\EntradasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntradasRepository::class)
 */
class Entradas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class, inversedBy="entradas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codigo;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="float")
     */
    private $valundent;

    /**
     * @ORM\Column(type="float")
     */
    private $porcentaje;

    /**
     * @ORM\Column(type="float")
     */
    private $valundsalida;

    /**
     * @ORM\Column(type="float")
     */
    private $valventa;

    /**
     * @ORM\Column(type="float")
     */
    private $utilidad;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="entradas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usucrea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacrea;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?Productos
    {
        return $this->codigo;
    }

    public function setCodigo(?Productos $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

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

    public function getValundent(): ?float
    {
        return $this->valundent;
    }

    public function setValundent(float $valundent): self
    {
        $this->valundent = $valundent;

        return $this;
    }

    public function getPorcentaje(): ?float
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(float $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    public function getValundsalida(): ?float
    {
        return $this->valundsalida;
    }

    public function setValundsalida(float $valundsalida): self
    {
        $this->valundsalida = $valundsalida;

        return $this;
    }

    public function getValventa(): ?float
    {
        return $this->valventa;
    }

    public function setValventa(float $valventa): self
    {
        $this->valventa = $valventa;

        return $this;
    }

    public function getUtilidad(): ?float
    {
        return $this->utilidad;
    }

    public function setUtilidad(float $utilidad): self
    {
        $this->utilidad = $utilidad;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
