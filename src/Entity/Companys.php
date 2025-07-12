<?php

namespace App\Entity;

use App\Repository\CompanysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanysRepository::class)
 */
class Companys
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="companys")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuariocrea;

    /**
     * @ORM\OneToMany(targetEntity=Persons::class, mappedBy="compania")
     */
    private $persons;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNit(): ?string
    {
        return $this->nit;
    }

    public function setNit(string $nit): self
    {
        $this->nit = $nit;

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

    public function getUsuariocrea(): ?User
    {
        return $this->usuariocrea;
    }

    public function setUsuariocrea(?User $usuariocrea): self
    {
        $this->usuariocrea = $usuariocrea;

        return $this;
    }

    /**
     * @return Collection<int, Persons>
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }

    public function addPerson(Persons $person): self
    {
        if (!$this->persons->contains($person)) {
            $this->persons[] = $person;
            $person->setCompania($this);
        }

        return $this;
    }

    public function removePerson(Persons $person): self
    {
        if ($this->persons->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getCompania() === $this) {
                $person->setCompania(null);
            }
        }

        return $this;
    }
}
