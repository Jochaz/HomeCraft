<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieArticleRepository")
 */
class CategorieArticle
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
    private $Nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieArticle", inversedBy="categorieArticles")
     */
    private $CategorieArticle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieArticle", mappedBy="CategorieArticle")
     */
    private $categorieArticles;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Utilisable;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PhotoCategorie", inversedBy="categorieArticles")
     */
    private $PhotoCategorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="CategorieArticle")
     */
    private $articles;


    public function __construct()
    {
        $this->categorieArticles = new ArrayCollection();
        $this->PhotoCategorie = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getCategorieArticle(): ?self
    {
        return $this->CategorieArticle;
    }

    public function setCategorieArticle(?self $CategorieArticle): self
    {
        $this->CategorieArticle = $CategorieArticle;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategorieArticles(): Collection
    {
        return $this->categorieArticles;
    }

    public function addCategorieArticle(self $categorieArticle): self
    {
        if (!$this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles[] = $categorieArticle;
            $categorieArticle->setCategorieArticle($this);
        }

        return $this;
    }

    public function removeCategorieArticle(self $categorieArticle): self
    {
        if ($this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles->removeElement($categorieArticle);
            // set the owning side to null (unless already changed)
            if ($categorieArticle->getCategorieArticle() === $this) {
                $categorieArticle->setCategorieArticle(null);
            }
        }

        return $this;
    }

    public function getUtilisable(): ?bool
    {
        return $this->Utilisable;
    }

    public function setUtilisable(?bool $Utilisable): self
    {
        $this->Utilisable = $Utilisable;

        return $this;
    }

    /**
     * @return Collection|PhotoCategorie[]
     */
    public function getPhotoCategorie(): Collection
    {
        return $this->PhotoCategorie;
    }

    public function addPhotoCategorie(PhotoCategorie $photoCategorie): self
    {
        if (!$this->PhotoCategorie->contains($photoCategorie)) {
            $this->PhotoCategorie[] = $photoCategorie;
        }

        return $this;
    }

    public function removePhotoCategorie(PhotoCategorie $photoCategorie): self
    {
        if ($this->PhotoCategorie->contains($photoCategorie)) {
            $this->PhotoCategorie->removeElement($photoCategorie);
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addCategorieArticle($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removeCategorieArticle($this);
        }

        return $this;
    }
}
