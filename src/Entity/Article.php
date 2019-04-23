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
     * @ORM\Column(type="datetime")
     */
    private $DateAjoutArticle;

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
    private $Categorie;

    public function __construct()
    {
        $this->Categorie = new ArrayCollection();
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

    public function getDateAjoutArticle(): ?\DateTimeInterface
    {
        return $this->DateAjoutArticle;
    }

    public function setDateAjoutArticle(\DateTimeInterface $DateAjoutArticle): self
    {
        $this->DateAjoutArticle = $DateAjoutArticle;

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
    public function getCategorie(): Collection
    {
        return $this->Categorie;
    }

    public function addCategorie(CategorieArticle $categorie): self
    {
        if (!$this->Categorie->contains($categorie)) {
            $this->Categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(CategorieArticle $categorie): self
    {
        if ($this->Categorie->contains($categorie)) {
            $this->Categorie->removeElement($categorie);
        }

        return $this;
    }
}
