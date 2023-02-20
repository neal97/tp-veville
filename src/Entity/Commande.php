<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Membre $id_membre = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Vehicule $id_vehicule = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Agences::class)]
    private Collection $id_agence;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure_depart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure_fin = null;

    #[ORM\Column]
    private ?int $prix_total = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_enregistrement = null;

    #[ORM\ManyToOne]
    private ?Agences $agence = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Agences $fk_agence = null;

    public function __construct()
    {
        $this->id_agence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMembre(): ?Membre
    {
        return $this->id_membre;
    }

    public function setIdMembre(?Membre $id_membre): self
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    public function getIdVehicule(): ?Vehicule
    {
        return $this->id_vehicule;
    }

    public function setIdVehicule(?Vehicule $id_vehicule): self
    {
        $this->id_vehicule = $id_vehicule;

        return $this;
    }

    /**
     * @return Collection<int, agences>
     */
    public function getIdAgence(): Collection
    {
        return $this->id_agence;
    }

    public function addIdAgence(Agences $idAgence): self
    {
        if (!$this->id_agence->contains($idAgence)) {
            $this->id_agence->add($idAgence);
            $idAgence->setCommande($this);
        }

        return $this;
    }

    public function removeIdAgence(Agences $idAgence): self
    {
        if ($this->id_agence->removeElement($idAgence)) {
            // set the owning side to null (unless already changed)
            if ($idAgence->getCommande() === $this) {
                $idAgence->setCommande(null);
            }
        }

        return $this;
    }

    public function getDateHeureDepart(): ?\DateTimeInterface
    {
        return $this->date_heure_depart;
    }

    public function setDateHeureDepart(\DateTimeInterface $date_heure_depart): self
    {
        $this->date_heure_depart = $date_heure_depart;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->date_heure_fin;
    }

    public function setDateHeureFin(\DateTimeInterface $date_heure_fin): self
    {
        $this->date_heure_fin = $date_heure_fin;

        return $this;
    }

    public function getPrixTotal(): ?int
    {
        return $this->prix_total;
    }

    public function setPrixTotal(int $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    public function getAgence(): ?Agences
    {
        return $this->agence;
    }

    public function setAgence(?Agences $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getFkAgence(): ?Agences
    {
        return $this->fk_agence;
    }

    public function setFkAgence(?Agences $fk_agence): self
    {
        $this->fk_agence = $fk_agence;

        return $this;
    }
}