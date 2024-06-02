<?php

namespace App\Entity;

use App\Repository\UnidadesymonturasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnidadesymonturasRepository::class)]
class Unidadesymonturas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?unidades $idUnidad = null;

    #[ORM\ManyToOne]
    private ?monturas $idMonturas = null;

    #[ORM\Column]
    private ?int $puntos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUnidad(): ?unidades
    {
        return $this->idUnidad;
    }

    public function setIdUnidad(?unidades $idUnidad): static
    {
        $this->idUnidad = $idUnidad;

        return $this;
    }

    public function getIdMonturas(): ?monturas
    {
        return $this->idMonturas;
    }

    public function setIdMonturas(?monturas $idMonturas): static
    {
        $this->idMonturas = $idMonturas;

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
