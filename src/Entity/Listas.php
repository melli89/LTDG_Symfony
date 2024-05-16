<?php

namespace App\Entity;

use App\Repository\ListasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListasRepository::class)]
class Listas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $nombre_lista = null;

    #[ORM\Column]
    private ?int $puntos_partida = null;

    #[ORM\ManyToOne(inversedBy: 'listas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ejercito $ejercito = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreLista(): ?string
    {
        return $this->nombre_lista;
    }

    public function setNombreLista(?string $nombre_lista): static
    {
        $this->nombre_lista = $nombre_lista;

        return $this;
    }

    public function getPuntosPartida(): ?int
    {
        return $this->puntos_partida;
    }

    public function setPuntosPartida(int $puntos_partida): static
    {
        $this->puntos_partida = $puntos_partida;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getEjercito(): ?Ejercito
    {
        return $this->ejercito;
    }

    public function setEjercito(?Ejercito $ejercito): static
    {
        $this->ejercito = $ejercito;

        return $this;
    }

}
