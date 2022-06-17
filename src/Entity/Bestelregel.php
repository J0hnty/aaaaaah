<?php

namespace App\Entity;

use App\Repository\BestelregelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestelregelRepository::class)
 */
class Bestelregel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Pizza::class, inversedBy="bestelregels")
     */
    private $Pizza;

    /**
     * @ORM\ManyToOne(targetEntity=Bestelling::class, inversedBy="bestelregels")
     */
    private $Bestelling;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPizza(): ?Pizza
    {
        return $this->Pizza;
    }

    public function setPizza(?Pizza $Pizza): self
    {
        $this->Pizza = $Pizza;

        return $this;
    }

    public function getBestelling(): ?Bestelling
    {
        return $this->Bestelling;
    }

    public function setBestelling(?Bestelling $Bestelling): self
    {
        $this->Bestelling = $Bestelling;

        return $this;
    }
}
