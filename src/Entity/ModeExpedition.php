<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeExpeditionRepository")
 */
class ModeExpedition
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
    private $Libelle;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $MontantFDP;

    /**
     * @ORM\Column(type="boolean")
     */
    private $PlusActif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="ModeExpedition")
     */
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getMontantFDP(): ?float
    {
        return $this->MontantFDP;
    }

    public function setMontantFDP(float $MontantFDP): self
    {
        $this->MontantFDP = $MontantFDP;

        return $this;
    }

    public function getPlusActif(): ?bool
    {
        return $this->PlusActif;
    }

    public function setPlusActif(bool $PlusActif): self
    {
        $this->PlusActif = $PlusActif;

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
            $commande->setModeExpedition($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getModeExpedition() === $this) {
                $commande->setModeExpedition(null);
            }
        }

        return $this;
    }
}
