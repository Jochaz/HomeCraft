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
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", inversedBy="commandes")
     */
    private $Article;

    public function __construct()
    {
        $this->Article = new ArrayCollection();
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
     * @return Collection|Article[]
     */
    public function getArticle(): Collection
    {
        return $this->Article;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->Article->contains($article)) {
            $this->Article[] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->Article->contains($article)) {
            $this->Article->removeElement($article);
        }

        return $this;
    }
}
