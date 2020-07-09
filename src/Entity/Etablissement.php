<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtablissementRepository::class)
 */
class Etablissement extends User
{
    /**
     * @Id @OneToOne(targetEntity="User")
     * @JoinColumn(name="id", referencedColumnName="id")
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nomEtablissement;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
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
