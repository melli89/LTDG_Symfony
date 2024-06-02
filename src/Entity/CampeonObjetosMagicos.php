<?php

namespace App\Entity;

use App\Repository\CampeonObjetosMagicosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampeonObjetosMagicosRepository::class)]
class CampeonObjetosMagicos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?objetosmagicos $campeon = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?campeon $relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampeon(): ?objetosmagicos
    {
        return $this->campeon;
    }

    public function setCampeon(?objetosmagicos $campeon): static
    {
        $this->campeon = $campeon;

        return $this;
    }

    public function getRelation(): ?campeon
    {
        return $this->relation;
    }

    public function setRelation(?campeon $relation): static
    {
        $this->relation = $relation;

        return $this;
    }
}
