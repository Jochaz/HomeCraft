<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoArticleRepository")
 */
class PhotoArticle
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
    private $DescriptionPhotoArticle;

    /**
     * @ORM\Column(type="blob")
     */
    private $PhotoArticle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="Photo")
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionPhotoArticle(): ?string
    {
        return $this->DescriptionPhotoArticle;
    }

    public function setDescriptionPhotoArticle(?string $DescriptionPhotoArticle): self
    {
        $this->DescriptionPhotoArticle = $DescriptionPhotoArticle;

        return $this;
    }

    public function getPhotoArticle()
    {
        return base64_encode(stream_get_contents($this->PhotoArticle));
    }

    public function setPhotoArticle($PhotoArticle): self
    {
        $this->PhotoArticle = $PhotoArticle;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
