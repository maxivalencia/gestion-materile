<?php

namespace App\Entity;

use App\Repository\UniteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteRepository::class)]
class Unite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $sigle = null;

    #[ORM\OneToMany(targetEntity: Conversion::class, mappedBy: 'source')]
    private Collection $conversions;

    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'unite')]
    private Collection $stocks;

    #[ORM\OneToMany(targetEntity: Mouvement::class, mappedBy: 'unite')]
    private Collection $mouvements;

    public function __construct()
    {
        $this->conversions = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->mouvements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }

    /**
     * @return Collection<int, Conversion>
     */
    public function getConversions(): Collection
    {
        return $this->conversions;
    }

    public function addConversion(Conversion $conversion): static
    {
        if (!$this->conversions->contains($conversion)) {
            $this->conversions->add($conversion);
            $conversion->setSource($this);
        }

        return $this;
    }

    public function removeConversion(Conversion $conversion): static
    {
        if ($this->conversions->removeElement($conversion)) {
            // set the owning side to null (unless already changed)
            if ($conversion->getSource() === $this) {
                $conversion->setSource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setUnite($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getUnite() === $this) {
                $stock->setUnite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mouvement>
     */
    public function getMouvements(): Collection
    {
        return $this->mouvements;
    }

    public function addMouvement(Mouvement $mouvement): static
    {
        if (!$this->mouvements->contains($mouvement)) {
            $this->mouvements->add($mouvement);
            $mouvement->setUnite($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): static
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getUnite() === $this) {
                $mouvement->setUnite(null);
            }
        }

        return $this;
    }

    /*
    * tostring
    * @return string
    */
    public function __toString(): string
    {
        return $this->getSigle();
    }
}
