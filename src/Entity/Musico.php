<?php

namespace App\Entity;

use App\Repository\MusicoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicoRepository::class)]
class Musico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $puntos = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?unidades $id_Unidad = null;

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

    public function getIdUnidad(): ?unidades
    {
        return $this->id_Unidad;
    }

    public function setIdUnidad(unidades $id_Unidad): static
    {
        $this->id_Unidad = $id_Unidad;

        return $this;
    }
}
