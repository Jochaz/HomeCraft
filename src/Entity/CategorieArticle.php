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

    public function __construct()
    {
        $this->categorieArticles = new ArrayCollection();
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
}
