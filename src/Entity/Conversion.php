<?php

namespace App\Entity;

use App\Repository\ConversionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConversionRepository::class)]
class Conversion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'conversions')]
    private ?Unite $source = null;

    #[ORM\ManyToOne(inversedBy: 'conversions')]
    private ?Unite $destinataire = null;

    #[ORM\ManyToOne(inversedBy: 'conversions')]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSource(): ?Unite
    {
        return $this->source;
    }

    public function setSource(?Unite $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getDestinataire(): ?Unite
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Unite $destinataire): static
    {
        $this->destinataire = $destinataire;

        return $this;
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

    /*
    * tostring
    * @return string
    */
    public function __toString(): string
    {
        return $this->getQuantite();
    }
}
