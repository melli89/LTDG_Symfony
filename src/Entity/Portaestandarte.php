<?php

namespace App\Entity;

use App\Repository\PortaestandarteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortaestandarteRepository::class)]
class Portaestandarte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $puntos = null;

    #[ORM\Column]
    private ?int $puntosEstandarte = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?unidades $id_unidad = null;

    /**
     * @var Collection<int, objetosmagicos>
     */
    #[ORM\ManyToMany(targetEntity: objetosmagicos::class)]
    private Collection $estandartesMagicos;

    public function __construct()
    {
        $this->estandartesMagicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuntos(): ?int
    {
        return $this->puntos;
    }

    public function setPuntos(int $puntos): static
    {
        $this->puntos = $puntos;

        return $this;
    }

    public function getPuntosEstandarte(): ?int
    {
        return $this->puntosEstandarte;
    }

    public function setPuntosEstandarte(int $puntosEstandarte): static
    {
        $this->puntosEstandarte = $puntosEstandarte;

        return $this;
    }

    public function getIdUnidad(): ?unidades
    {
        return $this->id_unidad;
    }

    public function setIdUnidad(unidades $id_unidad): static
    {
        $this->id_unidad = $id_unidad;

        return $this;
    }

    /**
     * @return Collection<int, objetosmagicos>
     */
    public function getEstandartesMagicos(): Collection
    {
        return $this->estandartesMagicos;
    }

    public function addEstandartesMagico(objetosmagicos $estandartesMagico): static
    {
        if (!$this->estandartesMagicos->contains($estandartesMagico)) {
            $this->estandartesMagicos->add($estandartesMagico);
        }

        return $this;
    }

    public function removeEstandartesMagico(objetosmagicos $estandartesMagico): static
    {
        $this->estandartesMagicos->removeElement($estandartesMagico);

        return $this;
    }
}
