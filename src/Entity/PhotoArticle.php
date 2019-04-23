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
        return $this->PhotoArticle;
    }

    public function setPhotoArticle($PhotoArticle): self
    {
        $this->PhotoArticle = $PhotoArticle;

        return $this;
    }
}
