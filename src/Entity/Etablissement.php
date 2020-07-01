<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtablissementRepository::class)
 */
class Etablissement 
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
     * @ORM\Column(type="string", length=255)
     */
    private $nomEtablissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="etablissements")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Secretaire::class, mappedBy="etablissement")
     */
    private $secretaires;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="etablissement")
     */
    private $demandes;

    /**
     * @ORM\OneToMany(targetEntity=DirecteurPedagogique::class, mappedBy="etablissement")
     */
    private $directeurPedagogiques;

    /**
     * @ORM\OneToMany(targetEntity=Signalisation::class, mappedBy="etablissement")
     */
    private $signalisations;

    public function __construct()
    {
        $this->secretaires = new ArrayCollection();
        $this->demandes = new ArrayCollection();
        $this->directeurPedagogiques = new ArrayCollection();
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

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): self
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Secretaire[]
     */
    public function getSecretaires(): Collection
    {
        return $this->secretaires;
    }

    public function addSecretaire(Secretaire $secretaire): self
    {
        if (!$this->secretaires->contains($secretaire)) {
            $this->secretaires[] = $secretaire;
            $secretaire->setEtablissement($this);
        }

        return $this;
    }

    public function removeSecretaire(Secretaire $secretaire): self
    {
        if ($this->secretaires->contains($secretaire)) {
            $this->secretaires->removeElement($secretaire);
            // set the owning side to null (unless already changed)
            if ($secretaire->getEtablissement() === $this) {
                $secretaire->setEtablissement(null);
            }
        }

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
            $demande->setEtablissement($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->contains($demande)) {
            $this->demandes->removeElement($demande);
            // set the owning side to null (unless already changed)
            if ($demande->getEtablissement() === $this) {
                $demande->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DirecteurPedagogique[]
     */
    public function getDirecteurPedagogiques(): Collection
    {
        return $this->directeurPedagogiques;
    }

    public function addDirecteurPedagogique(DirecteurPedagogique $directeurPedagogique): self
    {
        if (!$this->directeurPedagogiques->contains($directeurPedagogique)) {
            $this->directeurPedagogiques[] = $directeurPedagogique;
            $directeurPedagogique->setEtablissement($this);
        }

        return $this;
    }

    public function removeDirecteurPedagogique(DirecteurPedagogique $directeurPedagogique): self
    {
        if ($this->directeurPedagogiques->contains($directeurPedagogique)) {
            $this->directeurPedagogiques->removeElement($directeurPedagogique);
            // set the owning side to null (unless already changed)
            if ($directeurPedagogique->getEtablissement() === $this) {
                $directeurPedagogique->setEtablissement(null);
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
            $signalisation->setEtablissement($this);
        }

        return $this;
    }

    public function removeSignalisation(Signalisation $signalisation): self
    {
        if ($this->signalisations->contains($signalisation)) {
            $this->signalisations->removeElement($signalisation);
            // set the owning side to null (unless already changed)
            if ($signalisation->getEtablissement() === $this) {
                $signalisation->setEtablissement(null);
            }
        }

        return $this;
    }
    
}
