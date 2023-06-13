<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Tamanos;
use App\Entity\Tallas;

/**
 * Pedidos
 *
 * @ORM\Table(name="pedidos", indexes={@ORM\Index(name="CodUsu", columns={"CodUsu"})})
 * @ORM\Entity
 */
class Pedidos
{
    /**
     * @var int
     *
     * @ORM\Column(name="CodPed", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codped;

    /**
     * @var UserInterface|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="CodUsu", referencedColumnName="id")
     */
    private $codusu;

    /**
     * @var int
     *
     * @ORM\Column(name="Enviado", type="integer", nullable=false)
     */
    private $enviado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $cantidad;

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }
    public function getCodped(): ?int
    {
        return $this->codped;
    }

    public function getCodusu(): ?UserInterface
    {
        return $this->codusu;
    }

    public function setCodusu(?UserInterface $codusu): self
    {
        $this->codusu = $codusu;

        return $this;
    }


    public function getEnviado(): ?int
    {
        return $this->enviado;
    }

    public function setEnviado(int $enviado): self
    {
        $this->enviado = $enviado;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metodoPago;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $talla;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tamano;


    public function getTalla(): ?string
    {
        return $this->talla;
    }

    public function setTalla(?string $talla): self
    {
        $this->talla = $talla;

        return $this;
    }

    public function getTamano(): ?string
    {
        return $this->tamano;
    }

    public function setTamano(?string $tamano): self
    {
        $this->tamano = $tamano;

        return $this;
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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

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

    public function getMetodoPago(): ?string
    {
        return $this->metodoPago;
    }

    public function setMetodoPago(string $metodoPago): self
    {
        $this->metodoPago = $metodoPago;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreProd;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $codProd;


    public function getNombreProd(): ?string
    {
        return $this->nombreProd;
    }

    public function setNombreProd(?string $nombreProd): self
    {
        $this->nombreProd = $nombreProd;

        return $this;
    }

    public function getCodProd(): ?string
    {
        return $this->codProd;
    }

    public function setCodProd(?string $codProd): self
    {
        $this->codProd = $codProd;

        return $this;
    }


}