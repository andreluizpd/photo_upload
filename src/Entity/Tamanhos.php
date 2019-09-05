<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TamanhosRepository")
 */
class Tamanhos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tamanho;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

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

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }
}
