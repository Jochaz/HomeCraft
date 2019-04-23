<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlePossedePhotoRepository")
 */
class ArticlePossedePhoto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PhotoArticle", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Photo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ArticleBlog", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?PhotoArticle
    {
        return $this->Photo;
    }

    public function setPhoto(PhotoArticle $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getArticle(): ?ArticleBlog
    {
        return $this->Article;
    }

    public function setArticle(ArticleBlog $Article): self
    {
        $this->Article = $Article;

        return $this;
    }
}
