<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingRepository::class)
 */
class Bestelling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="bestellings")
     */
    private $Klant;

    /**
     * @ORM\OneToMany(targetEntity=Bestelregel::class, mappedBy="Bestelling")
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getKlant(): ?Klant
    {
        return $this->Klant;
    }

    public function setKlant(?Klant $Klant): self
    {
        $this->Klant = $Klant;

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
            $bestelregel->setBestelling($this);
        }

        return $this;
    }

    public function removeBestelregel(Bestelregel $bestelregel): self
    {
        if ($this->bestelregels->removeElement($bestelregel)) {
            // set the owning side to null (unless already changed)
            if ($bestelregel->getBestelling() === $this) {
                $bestelregel->setBestelling(null);
            }
        }

        return $this;
    }
}
