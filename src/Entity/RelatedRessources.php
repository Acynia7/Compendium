<?php

namespace App\Entity;

use App\Repository\RelatedRessourcesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: RelatedRessourcesRepository::class)]
#[ApiResource]
class RelatedRessources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(inversedBy: 'relatedRessources')]
    private ?CelestialBodies $celestial_body_id = null;

    #[ORM\Column(length: 255, options: ['default' => 'submitted'])]
    private ?string $state = 'submitted';

    #[ORM\ManyToOne(inversedBy: 'relatedRessources')]
    private ?RelatedRessourcesType $type = null;

    #[ORM\ManyToOne(inversedBy: 'relatedRessources')]
    private ?User $user = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable("now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

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

    public function getCelestialBodyId(): ?CelestialBodies
    {
        return $this->celestial_body_id;
    }

    public function setCelestialBodyId(?CelestialBodies $celestial_body_id): static
    {
        $this->celestial_body_id = $celestial_body_id;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getType(): ?RelatedRessourcesType
    {
        return $this->type;
    }

    public function setType(?RelatedRessourcesType $type): static
    {
        $this->type = $type;

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
}
