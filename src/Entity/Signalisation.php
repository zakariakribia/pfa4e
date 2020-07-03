<?php

namespace App\Entity;

use App\Repository\SignalisationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SignalisationRepository::class)
 */
class Signalisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Laureat::class, inversedBy="signalisations")
     */
    private $laureat;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="signalisations")
     */
    private $etablissement;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLaureat(): ?Laureat
    {
        return $this->laureat;
    }

    public function setLaureat(?Laureat $laureat): self
    {
        $this->laureat = $laureat;

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
