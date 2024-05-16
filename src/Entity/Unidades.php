<?php

namespace App\Entity;

use App\Repository\UnidadesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnidadesRepository::class)]
class Unidades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 100)]
    private ?string $categoria = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?int $puntoMini = null;

    #[ORM\Column]
    private ?int $tamanoMinimo = null;

    #[ORM\Column]
    private ?int $tamanoMaximo = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ejercito $ejercito = null;



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
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


    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }



    public function getPuntoMini(): ?int
    {
        return $this->puntoMini;
    }

    public function setPuntoMini(int $puntoMini): static
    {
        $this->puntoMini = $puntoMini;

        return $this;
    }

    public function getTamanoMinimo(): ?int
    {
        return $this->tamanoMinimo;
    }

    public function setTamanoMinimo(int $tamanoMinimo): static
    {
        $this->tamanoMinimo = $tamanoMinimo;

        return $this;
    }

    public function getTamanoMaximo(): ?int
    {
        return $this->tamanoMaximo;
    }

    public function setTamanoMaximo(int $tamanoMaximo): static
    {
        $this->tamanoMaximo = $tamanoMaximo;

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
