<?php

namespace App\Entity;

use App\Repository\EjercitoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EjercitoRepository::class)]
class Ejercito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $raza = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $imagen = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaza(): ?string
    {
        return $this->raza;
    }

    public function setRaza(string $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }


}
