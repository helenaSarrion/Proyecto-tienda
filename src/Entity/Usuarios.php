<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuarios
{
    /**
     * @var int
     *
     * @ORM\Column(name="CodUsu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codusu;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=20, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="Clave", type="integer", nullable=false)
     */
    private $clave;


    /**
     * @var string
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     * 
     */
    private $email;

    public function getCodusu(): ?int
    {
        return $this->codusu;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getClave(): ?int
    {
        return $this->clave;
    }

    public function setClave(int $clave): self
    {
        $this->clave = $clave;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }


    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

}