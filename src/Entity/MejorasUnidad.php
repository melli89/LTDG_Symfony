<?php

namespace App\Entity;

use App\Repository\MejorasUnidadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MejorasUnidadRepository::class)]
class MejorasUnidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?unidades $unidad = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?mejoras $mejora_id = null;

    #[ORM\Column(length: 5)]
    private ?string $opcional = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnidad(): ?unidades
    {
        return $this->unidad;
    }

    public function setUnidad(?unidades $unidad): static
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function getMejoraId(): ?mejoras
    {
        return $this->mejora_id;
    }

    public function setMejoraId(?mejoras $mejora_id): static
    {
        $this->mejora_id = $mejora_id;

        return $this;
    }

    public function getOpcional(): ?string
    {
        return $this->opcional;
    }

    public function setOpcional(string $opcional): static
    {
        $this->opcional = $opcional;

        return $this;
    }
}
