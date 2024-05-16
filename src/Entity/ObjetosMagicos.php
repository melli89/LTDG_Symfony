<?php

namespace App\Entity;

use App\Repository\ObjetosMagicosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetosMagicosRepository::class)]
class ObjetosMagicos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $categoria = null;

    #[ORM\Column]
    private ?int $ptos = null;

    /**
     * @var Collection<int, unidades>
     */
    #[ORM\ManyToMany(targetEntity: unidades::class)]
    private Collection $objetosUnidad;

    public function __construct()
    {
        $this->objetosUnidad = new ArrayCollection();
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

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getPtos(): ?int
    {
        return $this->ptos;
    }

    public function setPtos(int $ptos): static
    {
        $this->ptos = $ptos;

        return $this;
    }

    /**
     * @return Collection<int, unidades>
     */
    public function getObjetosUnidad(): Collection
    {
        return $this->objetosUnidad;
    }

    public function addObjetosUnidad(unidades $objetosUnidad): static
    {
        if (!$this->objetosUnidad->contains($objetosUnidad)) {
            $this->objetosUnidad->add($objetosUnidad);
        }

        return $this;
    }

    public function removeObjetosUnidad(unidades $objetosUnidad): static
    {
        $this->objetosUnidad->removeElement($objetosUnidad);

        return $this;
    }

}
