<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="paniers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PanierArticle", mappedBy="Panier")
     */
    private $panierArticles;

    public function __construct()
    {
        $this->panierArticles = new ArrayCollection();
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

    /**
     * @return Collection|PanierArticle[]
     */
    public function getPanierArticles(): Collection
    {
        return $this->panierArticles;
    }

    public function addPanierArticle(PanierArticle $panierArticle): self
    {
        if (!$this->panierArticles->contains($panierArticle)) {
            $this->panierArticles[] = $panierArticle;
            $panierArticle->setPanier($this);
        }

        return $this;
    }

    public function removePanierArticle(PanierArticle $panierArticle): self
    {
        if ($this->panierArticles->contains($panierArticle)) {
            $this->panierArticles->removeElement($panierArticle);
            // set the owning side to null (unless already changed)
            if ($panierArticle->getPanier() === $this) {
                $panierArticle->setPanier(null);
            }
        }

        return $this;
    }


}
