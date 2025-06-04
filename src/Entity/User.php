<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, CelestialBodies>
     */
    #[ORM\OneToMany(targetEntity: CelestialBodies::class, mappedBy: 'addedBy')]
    private Collection $celestial;

    /**
     * @var Collection<int, UserSearchHistory>
     */
    #[ORM\OneToMany(targetEntity: UserSearchHistory::class, mappedBy: 'user')]
    private Collection $search_history;

    /**
     * @var Collection<int, Favorites>
     */
    #[ORM\OneToMany(targetEntity: Favorites::class, mappedBy: 'user')]
    private Collection $favorites;

    /**
     * @var Collection<int, RelatedRessources>
     */
    #[ORM\OneToMany(targetEntity: RelatedRessources::class, mappedBy: 'user')]
    private Collection $relatedRessources;

    public function __construct()
    {
        $this->celestial = new ArrayCollection();
        $this->search_history = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable("now");
        $this->relatedRessources = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, CelestialBodies>
     */
    public function getCelestial(): Collection
    {
        return $this->celestial;
    }

    public function addCelestial(CelestialBodies $celestial): static
    {
        if (!$this->celestial->contains($celestial)) {
            $this->celestial->add($celestial);
            $celestial->setAddedBy($this);
        }

        return $this;
    }

    public function removeCelestial(CelestialBodies $celestial): static
    {
        if ($this->celestial->removeElement($celestial)) {
            // set the owning side to null (unless already changed)
            if ($celestial->getAddedBy() === $this) {
                $celestial->setAddedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserSearchHistory>
     */
    public function getSearchHistory(): Collection
    {
        return $this->search_history;
    }

    public function addSearchHistory(UserSearchHistory $searchHistory): static
    {
        if (!$this->search_history->contains($searchHistory)) {
            $this->search_history->add($searchHistory);
            $searchHistory->setUser($this);
        }

        return $this;
    }

    public function removeSearchHistory(UserSearchHistory $searchHistory): static
    {
        if ($this->search_history->removeElement($searchHistory)) {
            // set the owning side to null (unless already changed)
            if ($searchHistory->getUser() === $this) {
                $searchHistory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorites>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorites $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUser() === $this) {
                $favorite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RelatedRessources>
     */
    public function getRelatedRessources(): Collection
    {
        return $this->relatedRessources;
    }

    public function addRelatedRessource(RelatedRessources $relatedRessource): static
    {
        if (!$this->relatedRessources->contains($relatedRessource)) {
            $this->relatedRessources->add($relatedRessource);
            $relatedRessource->setUser($this);
        }

        return $this;
    }

    public function removeRelatedRessource(RelatedRessources $relatedRessource): static
    {
        if ($this->relatedRessources->removeElement($relatedRessource)) {
            // set the owning side to null (unless already changed)
            if ($relatedRessource->getUser() === $this) {
                $relatedRessource->setUser(null);
            }
        }

        return $this;
    }
}