<?php

namespace App\Entity;

use App\Repository\UnidadesYMejorasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnidadesYMejorasRepository::class)]
class UnidadesYMejoras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unidades $id_unidad = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mejoras $idmejora = null;

    #[ORM\Column]
    private ?int $puntos = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdmejora(): ?Mejoras
    {
        return $this->idmejora;
    }

    public function setIdmejora(?Mejoras $idmejora): static
    {
        $this->idmejora = $idmejora;

        return $this;
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
}
