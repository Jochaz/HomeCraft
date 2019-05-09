<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $CodeArticle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomArticle;

    /**
     * @ORM\Column(type="text")
     */
    private $DescriptionArticle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $EnVente;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixUnitaireTTC;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategorieArticle", inversedBy="articles")
     */
    private $CategorieArticle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoArticle", mappedBy="article")
     */
    private $Photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PanierArticle", mappedBy="Article")
     */
    private $panierArticles;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixProduction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeArticle", mappedBy="Article")
     */
    private $commandeArticles;


    public function __construct()
    {
        $this->CategorieArticle = new ArrayCollection();
        $this->Photo = new ArrayCollection();
        $this->panierArticles = new ArrayCollection();
        $this->commandeArticles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeArticle(): ?string
    {
        return $this->CodeArticle;
    }

    public function setCodeArticle(string $CodeArticle): self
    {
        $this->CodeArticle = $CodeArticle;

        return $this;
    }

    public function getNomArticle(): ?string
    {
        return $this->NomArticle;
    }

    public function setNomArticle(string $NomArticle): self
    {
        $this->NomArticle = $NomArticle;

        return $this;
    }

    public function getDescriptionArticle(): ?string
    {
        return $this->DescriptionArticle;
    }

    public function setDescriptionArticle(string $DescriptionArticle): self
    {
        $this->DescriptionArticle = $DescriptionArticle;

        return $this;
    }

    public function getEnVente(): ?bool
    {
        return $this->EnVente;
    }

    public function setEnVente(bool $EnVente): self
    {
        $this->EnVente = $EnVente;

        return $this;
    }

    public function getPrixUnitaireTTC(): ?float
    {
        return $this->PrixUnitaireTTC;
    }

    public function setPrixUnitaireTTC(?float $PrixUnitaireTTC): self
    {
        $this->PrixUnitaireTTC = $PrixUnitaireTTC;

        return $this;
    }

    /**
     * @return Collection|CategorieArticle[]
     */
    public function getCategorieArticle(): Collection
    {
        return $this->CategorieArticle;
    }

    public function addCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if (!$this->CategorieArticle->contains($categorieArticle)) {
            $this->CategorieArticle[] = $categorieArticle;
        }

        return $this;
    }

    public function removeCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if ($this->CategorieArticle->contains($categorieArticle)) {
            $this->CategorieArticle->removeElement($categorieArticle);
        }

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

    /**
     * @return Collection|PhotoArticle[]
     */
    public function getPhoto(): Collection
    {
        return $this->Photo;
    }

    public function addPhoto(PhotoArticle $photo): self
    {
        if (!$this->Photo->contains($photo)) {
            $this->Photo[] = $photo;
            $photo->setArticle($this);
        }

        return $this;
    }

    public function removePhoto(PhotoArticle $photo): self
    {
        if ($this->Photo->contains($photo)) {
            $this->Photo->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getArticle() === $this) {
                $photo->setArticle(null);
            }
        }

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
            $panierArticle->setArticle($this);
        }

        return $this;
    }

    public function removePanierArticle(PanierArticle $panierArticle): self
    {
        if ($this->panierArticles->contains($panierArticle)) {
            $this->panierArticles->removeElement($panierArticle);
            // set the owning side to null (unless already changed)
            if ($panierArticle->getArticle() === $this) {
                $panierArticle->setArticle(null);
            }
        }

        return $this;
    }

    public function getPrixProduction(): ?float
    {
        return $this->PrixProduction;
    }

    public function setPrixProduction(?float $PrixProduction): self
    {
        $this->PrixProduction = $PrixProduction;

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
            $commandeArticle->setArticle($this);
        }

        return $this;
    }

    public function removeCommandeArticle(CommandeArticle $commandeArticle): self
    {
        if ($this->commandeArticles->contains($commandeArticle)) {
            $this->commandeArticles->removeElement($commandeArticle);
            // set the owning side to null (unless already changed)
            if ($commandeArticle->getArticle() === $this) {
                $commandeArticle->setArticle(null);
            }
        }

        return $this;
    }

}
