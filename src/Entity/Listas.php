<?php

namespace App\Entity;

use App\Repository\ListasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, UnidadUsuario>
     */
    #[ORM\OneToMany(targetEntity: UnidadUsuario::class, mappedBy: 'listas', orphanRemoval: true)]
    private Collection $unidades;

    public function __construct()
    {
        $this->unidades = new ArrayCollection();
    }


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

    /**
     * @return Collection<int, UnidadUsuario>
     */
    public function getUnidades(): Collection
    {
        return $this->unidades;
    }

    public function addUnidades(UnidadUsuario $unidades): static
    {
        if (!$this->unidades->contains($unidades)) {
            $this->unidades->add($unidades);
            $unidades->setListas($this);
        }

        return $this;
    }

    public function removeUnidades(UnidadUsuario $unidades): static
    {
        if ($this->unidades->removeElement($unidades)) {
            // set the owning side to null (unless already changed)
            if ($unidades->getListas() === $this) {
                $unidades->setListas(null);
            }
        }

        return $this;
    }

}
