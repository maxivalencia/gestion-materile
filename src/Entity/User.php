<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Service $service = null;

    #[ORM\OneToMany(targetEntity: Materiel::class, mappedBy: 'user')]
    private Collection $materiels;

    #[ORM\OneToMany(targetEntity: HistoriqueMateriel::class, mappedBy: 'user')]
    private Collection $historiqueMateriels;

    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'user')]
    private Collection $stocks;

    #[ORM\OneToMany(targetEntity: Mouvement::class, mappedBy: 'user_reception')]
    private Collection $mouvements;

    #[ORM\OneToMany(targetEntity: Mouvement::class, mappedBy: 'user_expedition')]
    private Collection $mouvementsexpediteur;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
        $this->historiqueMateriels = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->mouvements = new ArrayCollection();
        $this->mouvementsexpediteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

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

    /**
     * @return Collection<int, Materiel>
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): static
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels->add($materiel);
            $materiel->setUser($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): static
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getUser() === $this) {
                $materiel->setUser(null);
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
        return $this->getNom().' '.$this->getService();
    }

    /**
     * @return Collection<int, HistoriqueMateriel>
     */
    public function getHistoriqueMateriels(): Collection
    {
        return $this->historiqueMateriels;
    }

    public function addHistoriqueMateriel(HistoriqueMateriel $historiqueMateriel): static
    {
        if (!$this->historiqueMateriels->contains($historiqueMateriel)) {
            $this->historiqueMateriels->add($historiqueMateriel);
            $historiqueMateriel->setUser($this);
        }

        return $this;
    }

    public function removeHistoriqueMateriel(HistoriqueMateriel $historiqueMateriel): static
    {
        if ($this->historiqueMateriels->removeElement($historiqueMateriel)) {
            // set the owning side to null (unless already changed)
            if ($historiqueMateriel->getUser() === $this) {
                $historiqueMateriel->setUser(null);
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
            $stock->setUser($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getUser() === $this) {
                $stock->setUser(null);
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
            $mouvement->setUserReception($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): static
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getUserReception() === $this) {
                $mouvement->setUserReception(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mouvement>
     */
    public function getMouvementsexpediteur(): Collection
    {
        return $this->mouvementsexpediteur;
    }

    public function addMouvementsexpediteur(Mouvement $mouvementsexpediteur): static
    {
        if (!$this->mouvementsexpediteur->contains($mouvementsexpediteur)) {
            $this->mouvementsexpediteur->add($mouvementsexpediteur);
            $mouvementsexpediteur->setUserExpedition($this);
        }

        return $this;
    }

    public function removeMouvementsexpediteur(Mouvement $mouvementsexpediteur): static
    {
        if ($this->mouvementsexpediteur->removeElement($mouvementsexpediteur)) {
            // set the owning side to null (unless already changed)
            if ($mouvementsexpediteur->getUserExpedition() === $this) {
                $mouvementsexpediteur->setUserExpedition(null);
            }
        }

        return $this;
    }
}
