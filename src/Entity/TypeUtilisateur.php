<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeUtilisateurRepository")
 */
class TypeUtilisateur
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
    private $libelleTypeUtilisateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Utilisateur", mappedBy="idTypeUtilisateur")
     */
    private $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleTypeUtilisateur(): ?string
    {
        return $this->libelleTypeUtilisateur;
    }

    public function setLibelleTypeUtilisateur(string $libelleTypeUtilisateur): self
    {
        $this->libelleTypeUtilisateur = $libelleTypeUtilisateur;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setIdTypeUtilisateur($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->removeElement($utilisateur);
            // set the owning side to null (unless already changed)
            if ($utilisateur->getIdTypeUtilisateur() === $this) {
                $utilisateur->setIdTypeUtilisateur(null);
            }
        }

        return $this;
    }
}
