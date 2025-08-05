<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?string $motDePasse = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 20)]
    private ?string $role = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\OneToMany(mappedBy: 'organisateur', targetEntity: Evenement::class)]
    private Collection $evenementsOrganises;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Participation::class)]
    private Collection $participations;

    public function __construct()
    {
        $this->evenementsOrganises = new ArrayCollection();
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;
        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $date): static
    {
        $this->dateInscription = $date;
        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenementsOrganises(): Collection
    {
        return $this->evenementsOrganises;
    }

    public function addEvenementOrganise(Evenement $evenement): static
    {
        if (!$this->evenementsOrganises->contains($evenement)) {
            $this->evenementsOrganises->add($evenement);
            $evenement->setOrganisateur($this);
        }
        return $this;
    }

    public function removeEvenementOrganise(Evenement $evenement): static
    {
        if ($this->evenementsOrganises->removeElement($evenement)) {
            if ($evenement->getOrganisateur() === $this) {
                $evenement->setOrganisateur(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Participation>
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): static
    {
        if (!$this->participations->contains($participation)) {
            $this->participations->add($participation);
            $participation->setUtilisateur($this);
        }
        return $this;
    }

    public function removeParticipation(Participation $participation): static
    {
        if ($this->participations->removeElement($participation)) {
            if ($participation->getUtilisateur() === $this) {
                $participation->setUtilisateur(null);
            }
        }
        return $this;
    }

    
    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    
    public function getRoles(): array
    {
        return [$this->role ?? 'ROLE_USER'];
    }

    public function getUserIdentifier(): string
    {
        return $this->email ?? '';
    }

    public function getPassword(): ?string
    {
        return $this->motDePasse;
    }

    public function eraseCredentials(): void
    {
        
    }
}
