<?php

namespace App\Entity;

use App\Repository\MouvementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MouvementRepository::class)]
class Mouvement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?TypeMouvement $type = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?Etat $etat = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?Unite $unite = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?Fournisseur $fournisseur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reference = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $debutSerie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $finSerie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expiration = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'mouvements')]
    private ?self $expedition_id = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'expedition_id')]
    private Collection $mouvements;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_reception = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?User $user_reception = null;

    #[ORM\ManyToOne(inversedBy: 'mouvementsexpediteur')]
    private ?User $user_expedition = null;

    public function __construct()
    {
        $this->mouvements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getType(): ?TypeMouvement
    {
        return $this->type;
    }

    public function setType(?TypeMouvement $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDebutSerie(): ?string
    {
        return $this->debutSerie;
    }

    public function setDebutSerie(string $debutSerie): static
    {
        $this->debutSerie = $debutSerie;

        return $this;
    }

    public function getFinSerie(): ?string
    {
        return $this->finSerie;
    }

    public function setFinSerie(string $finSerie): static
    {
        $this->finSerie = $finSerie;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    /*
    * tostring
    * @return string
    */
    public function __toString(): string
    {
        return $this->getQuantite();
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(?\DateTimeInterface $expiration): static
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function getExpeditionId(): ?self
    {
        return $this->expedition_id;
    }

    public function setExpeditionId(?self $expedition_id): static
    {
        $this->expedition_id = $expedition_id;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMouvements(): Collection
    {
        return $this->mouvements;
    }

    public function addMouvement(self $mouvement): static
    {
        if (!$this->mouvements->contains($mouvement)) {
            $this->mouvements->add($mouvement);
            $mouvement->setExpeditionId($this);
        }

        return $this;
    }

    public function removeMouvement(self $mouvement): static
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getExpeditionId() === $this) {
                $mouvement->setExpeditionId(null);
            }
        }

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->date_reception;
    }

    public function setDateReception(?\DateTimeInterface $date_reception): static
    {
        $this->date_reception = $date_reception;

        return $this;
    }

    public function getUserReception(): ?User
    {
        return $this->user_reception;
    }

    public function setUserReception(?User $user_reception): static
    {
        $this->user_reception = $user_reception;

        return $this;
    }

    public function getUserExpedition(): ?User
    {
        return $this->user_expedition;
    }

    public function setUserExpedition(?User $user_expedition): static
    {
        $this->user_expedition = $user_expedition;

        return $this;
    }
}
