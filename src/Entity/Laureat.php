<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\LaureatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaureatRepository::class)
 */
class Laureat extends User
{
    /**
     * @Id @OneToOne(targetEntity="User")
     * @JoinColumn(name="id", referencedColumnName="id")
     **/
    private $id;

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

    public function __toString()
    {
        return $this->nom;
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
