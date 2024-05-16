<?php

namespace App\Entity;

use App\Repository\CampeonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampeonRepository::class)]
class Campeon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $puntos = null;

    #[ORM\Column]
    private ?int $ptosOM = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Unidades $id_unidad = null;

    /**
     * @var Collection<int, objetosmagicos>
     */
    #[ORM\ManyToMany(targetEntity: Objetosmagicos::class)]
    private Collection $objetosCampeon;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    public function __construct()
    {
        $this->objetosCampeon = new ArrayCollection();
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

    public function getPtosOM(): ?int
    {
        return $this->ptosOM;
    }

    public function setPtosOM(int $ptosOM): static
    {
        $this->ptosOM = $ptosOM;

        return $this;
    }

    public function getIdUnidad(): ?Unidades
    {
        return $this->id_unidad;
    }

    public function setIdUnidad(?Unidades $id_unidad): static
    {
        $this->id_unidad = $id_unidad;

        return $this;
    }

    
    /**
     * @return Collection<int, objetosmagicos>
     */
    public function getObjetosCampeon(): Collection
    {
        return $this->objetosCampeon;
    }

    public function addObjetosCampeon(Objetosmagicos $objetosCampeon): static
    {
        if (!$this->objetosCampeon->contains($objetosCampeon)) {
            $this->objetosCampeon->add($objetosCampeon);
        }

        return $this;
    }

    public function removeObjetosCampeon(Objetosmagicos $objetosCampeon): static
    {
        $this->objetosCampeon->removeElement($objetosCampeon);

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


}
