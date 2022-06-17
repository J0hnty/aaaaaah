<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PizzaRepository::class)
 */
class Pizza
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="pizzas")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Bestelregel::class, mappedBy="Pizza")
     */
    private $bestelregels;

    public function __construct()
    {
        $this->bestelregels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Bestelregel>
     */
    public function getBestelregels(): Collection
    {
        return $this->bestelregels;
    }

    public function addBestelregel(Bestelregel $bestelregel): self
    {
        if (!$this->bestelregels->contains($bestelregel)) {
            $this->bestelregels[] = $bestelregel;
            $bestelregel->setPizza($this);
        }

        return $this;
    }

    public function removeBestelregel(Bestelregel $bestelregel): self
    {
        if ($this->bestelregels->removeElement($bestelregel)) {
            // set the owning side to null (unless already changed)
            if ($bestelregel->getPizza() === $this) {
                $bestelregel->setPizza(null);
            }
        }

        return $this;
    }
}
