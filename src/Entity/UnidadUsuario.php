<?php

namespace App\Entity;

use App\Repository\UnidadUsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnidadUsuarioRepository::class)]
class UnidadUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $minisAmount = null;

    #[ORM\Column]
    private ?int $totalPoints = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unidades $model = null;

    #[ORM\ManyToOne]
    private ?Campeon $champion = null;

    #[ORM\ManyToOne]
    private ?Mejoras $upgrade = null;

    #[ORM\ManyToOne(inversedBy: 'unidades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Listas $listas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinisAmount(): ?int
    {
        return $this->minisAmount;
    }

    public function setMinisAmount(int $minisAmount): static
    {
        $this->minisAmount = $minisAmount;

        return $this;
    }

    public function getTotalPoints(): ?int
    {
        return $this->totalPoints;
    }

    public function setTotalPoints(int $totalPoints): static
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    public function getModel(): ?Unidades
    {
        return $this->model;
    }

    public function setModel(?Unidades $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getChampion(): ?Campeon
    {
        return $this->champion;
    }

    public function setChampion(?Campeon $champion): static
    {
        $this->champion = $champion;

        return $this;
    }

    public function getUpgrade(): ?Mejoras
    {
        return $this->upgrade;
    }

    public function setUpgrade(?Mejoras $upgrade): static
    {
        $this->upgrade = $upgrade;

        return $this;
    }

    public function getListas(): ?Listas
    {
        return $this->listas;
    }

    public function setListas(?Listas $listas): static
    {
        $this->listas = $listas;

        return $this;
    }
}
