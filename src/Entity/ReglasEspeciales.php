<?php

namespace App\Entity;

use App\Repository\ReglasEspecialesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReglasEspecialesRepository::class)]
class ReglasEspeciales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, unidades>
     */
    #[ORM\ManyToMany(targetEntity: Unidades::class)]
    private Collection $reglas_unidad;

    public function __construct()
    {
        $this->reglas_unidad = new ArrayCollection();
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
     * @return Collection<int, Unidades>
     */
    public function getReglasUnidad(): Collection
    {
        return $this->reglas_unidad;
    }

    public function addReglasUnidad(Unidades $reglasUnidad): static
    {
        if (!$this->reglas_unidad->contains($reglasUnidad)) {
            $this->reglas_unidad->add($reglasUnidad);
        }

        return $this;
    }

    public function removeReglasUnidad(unidades $reglasUnidad): static
    {
        $this->reglas_unidad->removeElement($reglasUnidad);

        return $this;
    }

}
