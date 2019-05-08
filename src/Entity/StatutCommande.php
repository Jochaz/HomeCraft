<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatutCommandeRepository")
 */
class StatutCommande
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
    private $LibelleStatut;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="StatutCommande")
     */
    private $commandes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CodeStatut;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleStatut(): ?string
    {
        return $this->LibelleStatut;
    }

    public function setLibelleStatut(string $LibelleStatut): self
    {
        $this->LibelleStatut = $LibelleStatut;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setStatutCommande($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getStatutCommande() === $this) {
                $commande->setStatutCommande(null);
            }
        }

        return $this;
    }

    public function getCodeStatut(): ?string
    {
        return $this->CodeStatut;
    }

    public function setCodeStatut(string $CodeStatut): self
    {
        $this->CodeStatut = $CodeStatut;

        return $this;
    }
}
