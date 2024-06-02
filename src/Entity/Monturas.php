<?php

namespace App\Entity;

use App\Repository\MonturasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonturasRepository::class)]
class Monturas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(nullable: true)]
    private ?int $movimiento = null;

    #[ORM\Column(nullable: true)]
    private ?int $ha = null;

    #[ORM\Column(nullable: true)]
    private ?int $hp = null;

    #[ORM\Column(nullable: true)]
    private ?int $resistencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $fuerza = null;

    #[ORM\Column(nullable: true)]
    private ?int $heridas = null;

    #[ORM\Column(nullable: true)]
    private ?int $iniciativa = null;

    #[ORM\Column(nullable: true)]
    private ?int $ataques = null;

    #[ORM\Column(nullable: true)]
    private ?int $liderazgo = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMovimiento(): ?int
    {
        return $this->movimiento;
    }

    public function setMovimiento(?int $movimiento): static
    {
        $this->movimiento = $movimiento;

        return $this;
    }

    public function getHa(): ?int
    {
        return $this->ha;
    }

    public function setHa(?int $ha): static
    {
        $this->ha = $ha;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(?int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getResistencia(): ?int
    {
        return $this->resistencia;
    }

    public function setResistencia(?int $resistencia): static
    {
        $this->resistencia = $resistencia;

        return $this;
    }

    public function getFuerza(): ?int
    {
        return $this->fuerza;
    }

    public function setFuerza(?int $fuerza): static
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function getHeridas(): ?int
    {
        return $this->heridas;
    }

    public function setHeridas(?int $heridas): static
    {
        $this->heridas = $heridas;

        return $this;
    }

    public function getIniciativa(): ?int
    {
        return $this->iniciativa;
    }

    public function setIniciativa(?int $iniciativa): static
    {
        $this->iniciativa = $iniciativa;

        return $this;
    }

    public function getAtaques(): ?int
    {
        return $this->ataques;
    }

    public function setAtaques(?int $ataques): static
    {
        $this->ataques = $ataques;

        return $this;
    }

    public function getLiderazgo(): ?int
    {
        return $this->liderazgo;
    }

    public function setLiderazgo(?int $liderazgo): static
    {
        $this->liderazgo = $liderazgo;

        return $this;
    }
}
