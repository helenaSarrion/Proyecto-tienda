<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productos
 * @ORM\Table(name="productos", indexes={@ORM\Index(name="Categoria", columns={"Categoria"})})
 * @ORM\Entity
 */
class Productos
{
    /**
     * @var int
     *
     * @ORM\Column(name="CodProd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codprod;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=90, nullable=false)
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="Stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var int
     *
     * @ORM\Column(name="Categoria", type="integer", nullable=false)
     */
    private $categoria;

    /**
     * @var int
     *
     * @ORM\Column(name="Precio", type="integer", nullable=false)
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $additionalImages;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_talla;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_tamano;

    public function getIdTalla(): ?int
    {
        return $this->id_talla;
    }

    public function setIdTalla(?int $id_talla): self
    {
        $this->id_talla = $id_talla;

        return $this;
    }

    public function getIdTamano(): ?int
    {
        return $this->id_tamano;
    }

    public function setIdTamano(?int $id_tamano): self
    {
        $this->id_tamano = $id_tamano;

        return $this;
    }

    public function getAdditionalImages(): ?string
    {
        return $this->additionalImages;
    }

    public function setAdditionalImages(string $additionalImages): self
    {
        $this->additionalImages = $additionalImages;

        return $this;
    }
    public function getCodprod(): ?int
    {
        return $this->codprod;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCategoria(): ?int
    {
        return $this->categoria;
    }

    public function setCategoria(int $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }


    /**
     * @ORM\Column(type="string", length=255)
     */
    public $image_link;

    public function getImageLink(): ?string
    {
        return $this->image_link;
    }

    public function setImageLink(string $image_link): self
    {
        $this->image_link = $image_link;

        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_creacion;

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): self
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }



}