<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Floors::class, mappedBy="usucrea")
     */
    private $floors;

    /**
     * @ORM\OneToMany(targetEntity=Rooms::class, mappedBy="usucrea")
     */
    private $rooms;

    /**
     * @ORM\OneToMany(targetEntity=Documents::class, mappedBy="usucrea")
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity=Companys::class, mappedBy="usuariocrea")
     */
    private $companys;

    /**
     * @ORM\OneToMany(targetEntity=Persons::class, mappedBy="usucrea")
     */
    private $persons;

    /**
     * @ORM\OneToMany(targetEntity=Turnos::class, mappedBy="usuario")
     */
    private $turnos;

    /**
     * @ORM\OneToMany(targetEntity=Services::class, mappedBy="usucrea")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Servicetype::class, mappedBy="usucrea")
     */
    private $servicetypes;

    /**
     * @ORM\OneToMany(targetEntity=Productos::class, mappedBy="usucrea")
     */
    private $productos;

    /**
     * @ORM\OneToMany(targetEntity=Inventario::class, mappedBy="usucrea")
     */
    private $inventarios;

    /**
     * @ORM\OneToMany(targetEntity=Inventario::class, mappedBy="usumodifica")
     */
    private $inventario_usumod;

    /**
     * @ORM\OneToMany(targetEntity=Entradas::class, mappedBy="usucrea")
     */
    private $entradas;

    public function __construct()
    {
        $this->floors = new ArrayCollection();
        $this->rooms = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->companys = new ArrayCollection();
        $this->persons = new ArrayCollection();
        $this->turnos = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->servicetypes = new ArrayCollection();
        $this->productos = new ArrayCollection();
        $this->inventarios = new ArrayCollection();
        $this->inventario_usumod = new ArrayCollection();
        $this->entradas = new ArrayCollection();
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Floors>
     */
    public function getFloors(): Collection
    {
        return $this->floors;
    }

    public function addFloor(Floors $floor): self
    {
        if (!$this->floors->contains($floor)) {
            $this->floors[] = $floor;
            $floor->setUsucrea($this);
        }

        return $this;
    }

    public function removeFloor(Floors $floor): self
    {
        if ($this->floors->removeElement($floor)) {
            // set the owning side to null (unless already changed)
            if ($floor->getUsucrea() === $this) {
                $floor->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rooms>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Rooms $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setUsucrea($this);
        }

        return $this;
    }

    public function removeRoom(Rooms $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getUsucrea() === $this) {
                $room->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Documents>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Documents $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setUsucrea($this);
        }

        return $this;
    }

    public function removeDocument(Documents $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getUsucrea() === $this) {
                $document->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Companys>
     */
    public function getCompanys(): Collection
    {
        return $this->companys;
    }

    public function addCompany(Companys $company): self
    {
        if (!$this->companys->contains($company)) {
            $this->companys[] = $company;
            $company->setUsuariocrea($this);
        }

        return $this;
    }

    public function removeCompany(Companys $company): self
    {
        if ($this->companys->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getUsuariocrea() === $this) {
                $company->setUsuariocrea(null);
            }
        }

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
            $person->setUsucrea($this);
        }

        return $this;
    }

    public function removePerson(Persons $person): self
    {
        if ($this->persons->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getUsucrea() === $this) {
                $person->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Turnos>
     */
    public function getTurnos(): Collection
    {
        return $this->turnos;
    }

    public function addTurno(Turnos $turno): self
    {
        if (!$this->turnos->contains($turno)) {
            $this->turnos[] = $turno;
            $turno->setUsuario($this);
        }

        return $this;
    }

    public function removeTurno(Turnos $turno): self
    {
        if ($this->turnos->removeElement($turno)) {
            // set the owning side to null (unless already changed)
            if ($turno->getUsuario() === $this) {
                $turno->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setUsucrea($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getUsucrea() === $this) {
                $service->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Servicetype>
     */
    public function getServicetypes(): Collection
    {
        return $this->servicetypes;
    }

    public function addServicetype(Servicetype $servicetype): self
    {
        if (!$this->servicetypes->contains($servicetype)) {
            $this->servicetypes[] = $servicetype;
            $servicetype->setUsucrea($this);
        }

        return $this;
    }

    public function removeServicetype(Servicetype $servicetype): self
    {
        if ($this->servicetypes->removeElement($servicetype)) {
            // set the owning side to null (unless already changed)
            if ($servicetype->getUsucrea() === $this) {
                $servicetype->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Productos>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Productos $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setUsucrea($this);
        }

        return $this;
    }

    public function removeProducto(Productos $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getUsucrea() === $this) {
                $producto->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventario>
     */
    public function getInventarios(): Collection
    {
        return $this->inventarios;
    }

    public function addInventario(Inventario $inventario): self
    {
        if (!$this->inventarios->contains($inventario)) {
            $this->inventarios[] = $inventario;
            $inventario->setUsucrea($this);
        }

        return $this;
    }

    public function removeInventario(Inventario $inventario): self
    {
        if ($this->inventarios->removeElement($inventario)) {
            // set the owning side to null (unless already changed)
            if ($inventario->getUsucrea() === $this) {
                $inventario->setUsucrea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventario>
     */
    public function getInventarioUsumod(): Collection
    {
        return $this->inventario_usumod;
    }

    public function addInventarioUsumod(Inventario $inventarioUsumod): self
    {
        if (!$this->inventario_usumod->contains($inventarioUsumod)) {
            $this->inventario_usumod[] = $inventarioUsumod;
            $inventarioUsumod->setUsumodifica($this);
        }

        return $this;
    }

    public function removeInventarioUsumod(Inventario $inventarioUsumod): self
    {
        if ($this->inventario_usumod->removeElement($inventarioUsumod)) {
            // set the owning side to null (unless already changed)
            if ($inventarioUsumod->getUsumodifica() === $this) {
                $inventarioUsumod->setUsumodifica(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entradas>
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entradas $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
            $entrada->setUsucrea($this);
        }

        return $this;
    }

    public function removeEntrada(Entradas $entrada): self
    {
        if ($this->entradas->removeElement($entrada)) {
            // set the owning side to null (unless already changed)
            if ($entrada->getUsucrea() === $this) {
                $entrada->setUsucrea(null);
            }
        }

        return $this;
    }
}
