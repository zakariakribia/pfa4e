<?php

namespace App\Entity;

use App\Repository\LaureatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaureatRepository::class)
 */
class Laureat
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
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;
    /**
     * @ORM\Column(type="date")
     */
    private $datenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cinNumSejour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomArabe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomArabe;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="laureat")
     */
    private $demandes;

    /**
     * @ORM\OneToMany(targetEntity=Signalisation::class, mappedBy="laureat")
     */
    private $signalisations;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->signalisations = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl(string $photoUrl): self
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    public function getCinNumSejour(): ?string
    {
        return $this->cinNumSejour;
    }

    public function setCinNumSejour(string $cinNumSejour): self
    {
        $this->cinNumSejour = $cinNumSejour;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNomArabe(): ?string
    {
        return $this->nomArabe;
    }

    public function setNomArabe(string $nomArabe): self
    {
        $this->nomArabe = $nomArabe;

        return $this;
    }

    public function getPrenomArabe(): ?string
    {
        return $this->prenomArabe;
    }

    public function setPrenomArabe(string $prenomArabe): self
    {
        $this->prenomArabe = $prenomArabe;

        return $this;
    }

    /**
     * @return Collection|Demande[]
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setLaureat($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->contains($demande)) {
            $this->demandes->removeElement($demande);
            // set the owning side to null (unless already changed)
            if ($demande->getLaureat() === $this) {
                $demande->setLaureat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Signalisation[]
     */
    public function getSignalisations(): Collection
    {
        return $this->signalisations;
    }

    public function addSignalisation(Signalisation $signalisation): self
    {
        if (!$this->signalisations->contains($signalisation)) {
            $this->signalisations[] = $signalisation;
            $signalisation->setLaureat($this);
        }

        return $this;
    }

    public function removeSignalisation(Signalisation $signalisation): self
    {
        if ($this->signalisations->contains($signalisation)) {
            $this->signalisations->removeElement($signalisation);
            // set the owning side to null (unless already changed)
            if ($signalisation->getLaureat() === $this) {
                $signalisation->setLaureat(null);
            }
        }

        return $this;
    }

    
}
