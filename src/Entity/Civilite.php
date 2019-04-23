<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CiviliteRepository")
 */
class Civilite
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
    private $LibelleCivilite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $AbreviationCivilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="Civilite")
     */
    private $clients;

    public function __construct()
    {
        $this->IdCivilite = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCivilite(): ?string
    {
        return $this->LibelleCivilite;
    }

    public function setLibelleCivilite(string $LibelleCivilite): self
    {
        $this->LibelleCivilite = $LibelleCivilite;

        return $this;
    }

    public function getAbreviationCivilite(): ?string
    {
        return $this->AbreviationCivilite;
    }

    public function setAbreviationCivilite(string $AbreviationCivilite): self
    {
        $this->AbreviationCivilite = $AbreviationCivilite;

        return $this;
    }

    public function addIdCivilite(Client $idCivilite): self
    {
        if (!$this->IdCivilite->contains($idCivilite)) {
            $this->IdCivilite[] = $idCivilite;
            $idCivilite->setCodeCivilite($this);
        }

        return $this;
    }

    public function removeIdCivilite(Client $idCivilite): self
    {
        if ($this->IdCivilite->contains($idCivilite)) {
            $this->IdCivilite->removeElement($idCivilite);
            // set the owning side to null (unless already changed)
            if ($idCivilite->getCodeCivilite() === $this) {
                $idCivilite->setCodeCivilite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setCivilite($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getCivilite() === $this) {
                $client->setCivilite(null);
            }
        }

        return $this;
    }
}
