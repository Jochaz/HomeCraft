<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commandes")
     */
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModeExpedition", inversedBy="commandes")
     */
    private $ModeExpedition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="commandes")
     */
    private $AdresseLivraison;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="commandes")
     */
    private $AdresseFacturation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StatutCommande", inversedBy="commandes")
     */
    private $StatutCommande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModePaiement", inversedBy="commandes")
     */
    private $ModePaiement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $EstRegle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeArticle", mappedBy="Commande")
     */
    private $commandeArticles;

    public function __construct()
    {
        $this->commandeArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getModeExpedition(): ?ModeExpedition
    {
        return $this->ModeExpedition;
    }

    public function setModeExpedition(?ModeExpedition $ModeExpedition): self
    {
        $this->ModeExpedition = $ModeExpedition;

        return $this;
    }

    public function getAdresseLivraison(): ?Adresse
    {
        return $this->AdresseLivraison;
    }

    public function setAdresseLivraison(?Adresse $AdresseLivraison): self
    {
        $this->AdresseLivraison = $AdresseLivraison;

        return $this;
    }

    public function getAdresseFacturation(): ?Adresse
    {
        return $this->AdresseFacturation;
    }

    public function setAdresseFacturation(?Adresse $AdresseFacturation): self
    {
        $this->AdresseFacturation = $AdresseFacturation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStatutCommande(): ?StatutCommande
    {
        return $this->StatutCommande;
    }

    public function setStatutCommande(?StatutCommande $StatutCommande): self
    {
        $this->StatutCommande = $StatutCommande;

        return $this;
    }

    public function getModePaiement(): ?ModePaiement
    {
        return $this->ModePaiement;
    }

    public function setModePaiement(?ModePaiement $ModePaiement): self
    {
        $this->ModePaiement = $ModePaiement;

        return $this;
    }

    public function getEstRegle(): ?bool
    {
        return $this->EstRegle;
    }

    public function setEstRegle(bool $EstRegle): self
    {
        $this->EstRegle = $EstRegle;

        return $this;
    }

    /**
     * @return Collection|CommandeArticle[]
     */
    public function getCommandeArticles(): Collection
    {
        return $this->commandeArticles;
    }

    public function addCommandeArticle(CommandeArticle $commandeArticle): self
    {
        if (!$this->commandeArticles->contains($commandeArticle)) {
            $this->commandeArticles[] = $commandeArticle;
            $commandeArticle->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeArticle(CommandeArticle $commandeArticle): self
    {
        if ($this->commandeArticles->contains($commandeArticle)) {
            $this->commandeArticles->removeElement($commandeArticle);
            // set the owning side to null (unless already changed)
            if ($commandeArticle->getCommande() === $this) {
                $commandeArticle->setCommande(null);
            }
        }

        return $this;
    }
}
