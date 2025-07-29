<?php

namespace App\Entity;

use App\Repository\InventarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventarioRepository::class)
 */
class Inventario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class, inversedBy="inventarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codigo;

    /**
     * @ORM\Column(type="integer")
     */
    private $entradas;

    /**
     * @ORM\Column(type="integer")
     */
    private $salidas;

    /**
     * @ORM\Column(type="integer")
     */
    private $existencias;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inventario_usucrea")
     */
    private $usucrea;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechacrea;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inventario_usumod")
     */
    private $usumod;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechamod;

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

    public function getEntradas(): ?int
    {
        return $this->entradas;
    }

    public function setEntradas(int $entradas): self
    {
        $this->entradas = $entradas;

        return $this;
    }

    public function getSalidas(): ?int
    {
        return $this->salidas;
    }

    public function setSalidas(int $salidas): self
    {
        $this->salidas = $salidas;

        return $this;
    }

    public function getExistencias(): ?int
    {
        return $this->existencias;
    }

    public function setExistencias(int $existencias): self
    {
        $this->existencias = $existencias;

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

    public function setFechacrea(?\DateTimeInterface $fechacrea): self
    {
        $this->fechacrea = $fechacrea;

        return $this;
    }

    public function getUsumod(): ?User
    {
        return $this->usumod;
    }

    public function setUsumod(?User $usumod): self
    {
        $this->usumod = $usumod;

        return $this;
    }

    public function getFechamod(): ?\DateTimeInterface
    {
        return $this->fechamod;
    }

    public function setFechamod(?\DateTimeInterface $fechamod): self
    {
        $this->fechamod = $fechamod;

        return $this;
    }
}
