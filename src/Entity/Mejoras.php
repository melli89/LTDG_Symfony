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

    public function addEquipamientoUnidad(unidades $equipamientoUnidad): static
    {
        if (!$this->equipamientoUnidad->contains($equipamientoUnidad)) {
            $this->equipamientoUnidad->add($equipamientoUnidad);
        }

        return $this;
    }

    public function removeEquipamientoUnidad(unidades $equipamientoUnidad): static
    {
        $this->equipamientoUnidad->removeElement($equipamientoUnidad);

        return $this;
    }

}
