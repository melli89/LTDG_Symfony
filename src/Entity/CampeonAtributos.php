<?php

namespace App\Entity;

use App\Repository\CampeonAtributosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampeonAtributosRepository::class)]
class CampeonAtributos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $movimiento = null;

    #[ORM\Column]
    private ?int $habilidadArma = null;

    #[ORM\Column]
    private ?int $habilidadProyectil = null;

    #[ORM\Column]
    private ?int $fuerza = null;

    #[ORM\Column]
    private ?int $resistencia = null;

    #[ORM\Column]
    private ?int $heridas = null;

    #[ORM\Column]
    private ?int $iniciativa = null;

    #[ORM\Column]
    private ?int $ataque = null;

    #[ORM\Column]
    private ?int $liderazgo = null;

    #[ORM\ManyToOne]
    private ?campeon $idCampeon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovimiento(): ?int
    {
        return $this->movimiento;
    }

    public function setMovimiento(int $movimiento): static
    {
        $this->movimiento = $movimiento;

        return $this;
    }

    public function getHabilidadArma(): ?int
    {
        return $this->habilidadArma;
    }

    public function setHabilidadArma(int $habilidadArma): static
    {
        $this->habilidadArma = $habilidadArma;

        return $this;
    }

    public function getHabilidadProyectil(): ?int
    {
        return $this->habilidadProyectil;
    }

    public function setHabilidadProyectil(int $habilidadProyectil): static
    {
        $this->habilidadProyectil = $habilidadProyectil;

        return $this;
    }

    public function getFuerza(): ?int
    {
        return $this->fuerza;
    }

    public function setFuerza(int $fuerza): static
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function getResistencia(): ?int
    {
        return $this->resistencia;
    }

    public function setResistencia(int $resistencia): static
    {
        $this->resistencia = $resistencia;

        return $this;
    }

    public function getHeridas(): ?int
    {
        return $this->heridas;
    }

    public function setHeridas(int $heridas): static
    {
        $this->heridas = $heridas;

        return $this;
    }

    public function getIniciativa(): ?int
    {
        return $this->iniciativa;
    }

    public function setIniciativa(int $iniciativa): static
    {
        $this->iniciativa = $iniciativa;

        return $this;
    }

    public function getAtaque(): ?int
    {
        return $this->ataque;
    }

    public function setAtaque(int $ataque): static
    {
        $this->ataque = $ataque;

        return $this;
    }

    public function getLiderazgo(): ?int
    {
        return $this->liderazgo;
    }

    public function setLiderazgo(int $liderazgo): static
    {
        $this->liderazgo = $liderazgo;

        return $this;
    }

    public function getIdCampeon(): ?campeon
    {
        return $this->idCampeon;
    }

    public function setIdCampeon(?campeon $idCampeon): static
    {
        $this->idCampeon = $idCampeon;

        return $this;
    }
}
