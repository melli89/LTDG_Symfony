<?php

namespace App\Entity;

use App\Repository\MejorasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MejorasRepository::class)]
class Mejoras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300, nullable: true)]
    private ?string $descripcion = null;


    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, unidades>
     */
    #[ORM\ManyToMany(targetEntity: Unidades::class)]
    private Collection $equipamientoUnidad;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $rango = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $fuerza = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $penetracion = null;


    public function __construct()
    {
        $this->equipamientoUnidad = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }


    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, unidades>
     */
    public function getEquipamientoUnidad(): Collection
    {
        return $this->equipamientoUnidad;
    }

    public function addEquipamientoUnidad(Unidades $equipamientoUnidad): static
    {
        if (!$this->equipamientoUnidad->contains($equipamientoUnidad)) {
            $this->equipamientoUnidad->add($equipamientoUnidad);
        }

        return $this;
    }

    public function removeEquipamientoUnidad(Unidades $equipamientoUnidad): static
    {
        $this->equipamientoUnidad->removeElement($equipamientoUnidad);

        return $this;
    }

    public function getRango(): ?string
    {
        return $this->rango;
    }

    public function setRango(?string $rango): static
    {
        $this->rango = $rango;

        return $this;
    }

    public function getFuerza(): ?string
    {
        return $this->fuerza;
    }

    public function setFuerza(?string $fuerza): static
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function getPenetracion(): ?string
    {
        return $this->penetracion;
    }

    public function setPenetracion(?string $penetracion): static
    {
        $this->penetracion = $penetracion;

        return $this;
    }

}
