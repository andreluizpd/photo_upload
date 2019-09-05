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
     * @ORM\Column(type="integer")
     */
    private $copias;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoFileName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tamanhos", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tamanho;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCopias(): ?int
    {
        return $this->copias;
    }

    public function setCopias(int $copias): self
    {
        $this->copias = $copias;

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

    public function getTamanho(): ?Tamanhos
    {
        return $this->tamanho;
    }

    public function setTamanho(?Tamanhos $tamanho): self
    {
        $this->tamanho = $tamanho;

        return $this;
    }
}
