<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeAdresseRepository")
 */
class TypeAdresse
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
    private $LibelleTypeAdresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="TypeAdresse")
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

    public function getLibelleTypeAdresse(): ?string
    {
        return $this->LibelleTypeAdresse;
    }

    public function setLibelleTypeAdresse(string $LibelleTypeAdresse): self
    {
        $this->LibelleTypeAdresse = $LibelleTypeAdresse;

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
            $adress->setTypeAdresse($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getTypeAdresse() === $this) {
                $adress->setTypeAdresse(null);
            }
        }

        return $this;
    }
}
