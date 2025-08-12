<?php

namespace App\Entity;

use App\Repository\DetallesmovRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetallesmovRepository::class)
 */
class Detallesmov
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Movimientos::class, inversedBy="detallesmovs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mov;

    /**
     * @ORM\ManyToOne(targetEntity=services::class, inversedBy="detallesmovs")
     */
    private $servicio;

    /**
     * @ORM\ManyToOne(targetEntity=productos::class, inversedBy="detallesmovs")
     */
    private $producto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="float")
     */
    private $saldo;

    /**
     * @ORM\Column(type="integer")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=turnos::class, inversedBy="detallesmovs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $turno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMov(): ?movimientos
    {
        return $this->mov;
    }

    public function setMov(?movimientos $mov): self
    {
        $this->mov = $mov;

        return $this;
    }

    public function getServicio(): ?services
    {
        return $this->servicio;
    }

    public function setServicio(?services $servicio): self
    {
        $this->servicio = $servicio;

        return $this;
    }

    public function getProducto(): ?productos
    {
        return $this->producto;
    }

    public function setProducto(?productos $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
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

    public function getSaldo(): ?float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): self
    {
        $this->saldo = $saldo;

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

    public function getTurno(): ?turnos
    {
        return $this->turno;
    }

    public function setTurno(?turnos $turno): self
    {
        $this->turno = $turno;

        return $this;
    }
}
