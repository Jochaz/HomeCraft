<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @UniqueEntity(
 *   fields={"EmailClient"},
 *   message="L'email que vous avez saisie est déjà utilisé"
 * )
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Civilite", inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Civilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomClient;

    /**
     * @ORM\Column(type="date")
     */
    private $DateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $EmailClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     */
    private $PasswordClient;

    /**
     * @Assert\EqualTo(propertyPath="PasswordConfirmClient", message="Votre mot de passe est différent")
     */
    public $PasswordConfirmClient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Panier", mappedBy="Client", orphanRemoval=true)
     */
    private $paniers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleBlog", mappedBy="Client")
     */
    private $articleBlogs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="Client")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="Client")
     */
    private $adresses;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->paniers = new ArrayCollection();
        $this->articleBlogs = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?Civilite
    {
        return $this->Civilite;
    }

    public function setCivilite(?Civilite $Civilite): self
    {
        $this->Civilite = $Civilite;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->NomClient;
    }

    public function setNomClient(string $NomClient): self
    {
        $this->NomClient = $NomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->PrenomClient;
    }

    public function setPrenomClient(string $PrenomClient): self
    {
        $this->PrenomClient = $PrenomClient;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->EmailClient;
    }

    public function setEmailClient(string $EmailClient): self
    {
        $this->EmailClient = $EmailClient;

        return $this;
    }

    public function getPasswordClient(): ?string
    {
        return $this->PasswordClient;
    }

    public function setPasswordClient(string $PasswordClient): self
    {
        $this->PasswordClient = $PasswordClient;

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

    public function eraseCredentials() {}
    public function getSalt(){}

    public function getRoles(){
        if ($this->EmailClient == 'jordan.chariot@gmail.co') {
            return ['ROLE_ADMIN'];
        } else {
            return ['ROLE_USER'];
        }
        
    }

    public function getPassword(){
        return $this->PasswordClient; 
    }

    public function getUserName(){
        return $this->EmailClient;
    }

    /**
     * @return Collection|Panier[]
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->setClient($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->contains($panier)) {
            $this->paniers->removeElement($panier);
            // set the owning side to null (unless already changed)
            if ($panier->getClient() === $this) {
                $panier->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleBlog[]
     */
    public function getArticleBlogs(): Collection
    {
        return $this->articleBlogs;
    }

    public function addArticleBlog(ArticleBlog $articleBlog): self
    {
        if (!$this->articleBlogs->contains($articleBlog)) {
            $this->articleBlogs[] = $articleBlog;
            $articleBlog->setClient($this);
        }

        return $this;
    }

    public function removeArticleBlog(ArticleBlog $articleBlog): self
    {
        if ($this->articleBlogs->contains($articleBlog)) {
            $this->articleBlogs->removeElement($articleBlog);
            // set the owning side to null (unless already changed)
            if ($articleBlog->getClient() === $this) {
                $articleBlog->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setClient($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getClient() === $this) {
                $adress->setClient(null);
            }
        }

        return $this;
    }

}
