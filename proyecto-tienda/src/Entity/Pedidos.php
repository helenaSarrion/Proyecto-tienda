<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="CodUsu", type="integer", nullable=false)
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

    public function getCodped(): ?int
    {
        return $this->codped;
    }

    public function getCodusu(): ?int
    {
        return $this->codusu;
    }

    public function setCodusu(int $codusu): self
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


}
