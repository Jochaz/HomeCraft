<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleBlogRepository")
 */
class ArticleBlog
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="idUtilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUtilisateur;


    /**
     * @ORM\Column(type="boolean")
     */
    private $FlgSup;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoArticleBlog", mappedBy="articleBlog")
     */
    private $PhotoArticleBlog;

    public function __construct()
    {
        $this->PhotoArticleBlog = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

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

    /**
     * @return Collection|PhotoArticleBlog[]
     */
    public function getPhotoArticleBlog(): Collection
    {
        return $this->PhotoArticleBlog;
    }

    public function addPhotoArticleBlog(PhotoArticleBlog $photoArticleBlog): self
    {
        if (!$this->PhotoArticleBlog->contains($photoArticleBlog)) {
            $this->PhotoArticleBlog[] = $photoArticleBlog;
            $photoArticleBlog->setArticleBlog($this);
        }

        return $this;
    }

    public function removePhotoArticleBlog(PhotoArticleBlog $photoArticleBlog): self
    {
        if ($this->PhotoArticleBlog->contains($photoArticleBlog)) {
            $this->PhotoArticleBlog->removeElement($photoArticleBlog);
            // set the owning side to null (unless already changed)
            if ($photoArticleBlog->getArticleBlog() === $this) {
                $photoArticleBlog->setArticleBlog(null);
            }
        }

        return $this;
    }
}
