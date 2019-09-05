<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $preco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoFileName;

    /**
     * @ORM\Column(type="integer")
     */
    private $copias;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tamanhos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tamanho;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTamanho(): ?string
    {
        return $this->tamanho;
    }

    public function setTamanho(string $tamanho): self
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    public function getPhotoFileName(): ?string
    {
        return $this->photoFileName;
    }

    public function setPhotoFileName(string $photoFileName): self
    {
        $this->photoFileName = $photoFileName;

        return $this;
    }

    public function getCopias(): ?int
    {
        return $this->copias;
    }

    public function setCopias(int $copias): self
    {
        $this->copias = $copias;

        return $this;
    }
}
