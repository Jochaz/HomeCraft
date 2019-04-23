<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibellePays;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $CodeIso2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="relation")
     */
    private $adresses;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellePays(): ?string
    {
        return $this->LibellePays;
    }

    public function setLibellePays(string $LibellePays): self
    {
        $this->LibellePays = $LibellePays;

        return $this;
    }

    public function getCodeIso2(): ?string
    {
        return $this->CodeIso2;
    }

    public function setCodeIso2(string $CodeIso2): self
    {
        $this->CodeIso2 = $CodeIso2;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setRelation($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getRelation() === $this) {
                $adress->setRelation(null);
            }
        }

        return $this;
    }
}
