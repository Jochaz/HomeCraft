<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoArticleBlogRepository")
 */
class PhotoArticleBlog
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
    private $Description;

    /**
     * @ORM\Column(type="blob")
     */
    private $Photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleBlog", inversedBy="IdPhotoArticleBlog")
     */
    private $ArticleBlog;

    /**
     * @ORM\Column(type="boolean")
     */
    private $FlgSup;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPhoto()
    {
        return $this->Photo;
    }

    public function setPhoto($Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getArticleBlog(): ?ArticleBlog
    {
        return $this->ArticleBlog;
    }

    public function setArticleBlog(?ArticleBlog $ArticleBlog): self
    {
        $this->ArticleBlog = $ArticleBlog;

        return $this;
    }

    public function getFlgSup(): ?bool
    {
        return $this->FlgSup;
    }

    public function setFlgSup(bool $FlgSup): self
    {
        $this->FlgSup = $FlgSup;

        return $this;
    }
}
