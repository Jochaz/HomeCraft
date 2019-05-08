<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomAdresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Rue1Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Rue2Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Rue3Adresse;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $CodePostalAdresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $VilleAdresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays", inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PaysAdresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="AdresseLivraison")
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="adresses")
     */
    private $Client;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdresse(): ?string
    {
        return $this->NomAdresse;
    }

    public function setNomAdresse(?string $NomAdresse): self
    {
        $this->NomAdresse = $NomAdresse;

        return $this;
    }

    public function getRue1Adresse(): ?string
    {
        return $this->Rue1Adresse;
    }

    public function setRue1Adresse(string $Rue1Adresse): self
    {
        $this->Rue1Adresse = $Rue1Adresse;

        return $this;
    }

    public function getRue2Adresse(): ?string
    {
        return $this->Rue2Adresse;
    }

    public function setRue2Adresse(?string $Rue2Adresse): self
    {
        $this->Rue2Adresse = $Rue2Adresse;

        return $this;
    }

    public function getRue3Adresse(): ?string
    {
        return $this->Rue3Adresse;
    }

    public function setRue3Adresse(?string $Rue3Adresse): self
    {
        $this->Rue3Adresse = $Rue3Adresse;

        return $this;
    }

    public function getCodePostalAdresse(): ?string
    {
        return $this->CodePostalAdresse;
    }

    public function setCodePostalAdresse(string $CodePostalAdresse): self
    {
        $this->CodePostalAdresse = $CodePostalAdresse;

        return $this;
    }

    public function getVilleAdresse(): ?string
    {
        return $this->VilleAdresse;
    }

    public function setVilleAdresse(string $VilleAdresse): self
    {
        $this->VilleAdresse = $VilleAdresse;

        return $this;
    }

    public function getPaysAdresse(): ?Pays
    {
        return $this->PaysAdresse;
    }

    public function SetPaysAdresse(?Pays $PaysAdresse): self
    {
        $this->PaysAdresse = $PaysAdresse;

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
            $commande->setAdresseLivraison($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getAdresseLivraison() === $this) {
                $commande->setAdresseLivraison(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }
}
