<?php

namespace App\Entity;

use App\Repository\HistoriqueMaterielRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueMaterielRepository::class)]
class HistoriqueMateriel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sujet = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ancien = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $nouveau = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueMateriels')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueMateriels')]
    private ?Materiel $materiel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): static
    {
        $this->sujet = $sujet;

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

    public function getAncien(): ?string
    {
        return $this->ancien;
    }

    public function setAncien(?string $ancien): static
    {
        $this->ancien = $ancien;

        return $this;
    }

    public function getNouveau(): ?string
    {
        return $this->nouveau;
    }

    public function setNouveau(?string $nouveau): static
    {
        $this->nouveau = $nouveau;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): static
    {
        $this->materiel = $materiel;

        return $this;
    }

    /*
    * tostring
    * @return string
    */
    public function __toString(): string
    {
        return $this->getObjet();
    }
}
