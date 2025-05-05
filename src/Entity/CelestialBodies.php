<?php

namespace App\Entity;

use App\Repository\CelestialBodiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CelestialBodiesRepository::class)]
#[ApiResource]
class CelestialBodies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?string $mass = null;

    #[ORM\Column(nullable: true)]
    private ?string $radius = null;

    #[ORM\Column(nullable: true)]
    private ?string $distance_from_earth = null;

    #[ORM\Column(nullable: true)]
    private ?string $temperature = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'celestialBodies')]
    private ?CelestialBodyType $type = null;

    /**
     * @var Collection<int, RelatedRessources>
     */
    #[ORM\OneToMany(targetEntity: RelatedRessources::class, mappedBy: 'celestial_body_id')]
    private Collection $relatedRessources;

    /**
     * @var Collection<int, Favorites>
     */
    #[ORM\OneToMany(targetEntity: Favorites::class, mappedBy: 'celestialBodies')]
    private Collection $favorite;

    #[ORM\ManyToOne(inversedBy: 'celestial')]
    private ?User $addedBy = null;

    public function __construct()
    {
        $this->relatedRessources = new ArrayCollection();
        $this->favorite = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable("now");
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMass(): ?string
    {
        return $this->mass;
    }

    public function setMass(?string $mass): static
    {
        $this->mass = $mass;

        return $this;
    }

    public function getRadius(): ?string
    {
        return $this->radius;
    }

    public function setRadius(?string $radius): static
    {
        $this->radius = $radius;

        return $this;
    }

    public function getDistanceFromEarth(): ?string
    {
        return $this->distance_from_earth;
    }

    public function setDistanceFromEarth(?string $distance_from_earth): static
    {
        $this->distance_from_earth = $distance_from_earth;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(?string $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getType(): ?CelestialBodyType
    {
        return $this->type;
    }

    public function setType(?CelestialBodyType $type): static
    {
        $this->type = $type;

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
            $relatedRessource->setCelestialBodyId($this);
        }

        return $this;
    }

    public function removeRelatedRessource(RelatedRessources $relatedRessource): static
    {
        if ($this->relatedRessources->removeElement($relatedRessource)) {
            // set the owning side to null (unless already changed)
            if ($relatedRessource->getCelestialBodyId() === $this) {
                $relatedRessource->setCelestialBodyId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorites>
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    public function addFavorite(Favorites $favorite): static
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite->add($favorite);
            $favorite->setCelestialBodies($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): static
    {
        if ($this->favorite->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getCelestialBodies() === $this) {
                $favorite->setCelestialBodies(null);
            }
        }

        return $this;
    }

    public function getAddedBy(): ?User
    {
        return $this->addedBy;
    }

    public function setAddedBy(?User $addedBy): static
    {
        $this->addedBy = $addedBy;

        return $this;
    }
}
