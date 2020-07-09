<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\DirecteurPedagogiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DirecteurPedagogiqueRepository::class)
 */
class DirecteurPedagogique extends User
{
    /**
     * @Id @OneToOne(targetEntity="User")
     * @JoinColumn(name="id", referencedColumnName="id")
     **/
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="directeurPedagogique")
     */
    private $demandes;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="directeurPedagogiques")
     */
    private $etablissement;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     public function __toString()
     {
         return $this->nom;
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
            $demande->setDirecteurPedagogique($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->contains($demande)) {
            $this->demandes->removeElement($demande);
            // set the owning side to null (unless already changed)
            if ($demande->getDirecteurPedagogique() === $this) {
                $demande->setDirecteurPedagogique(null);
            }
        }

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }
}
