<?php

namespace App\Entity;

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


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
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
        return ['ROLE_USER'];
    }

    public function getPassword(){
        return $this->PasswordClient; 
    }

    public function getUserName(){
        return $this->EmailClient;
    }
}
