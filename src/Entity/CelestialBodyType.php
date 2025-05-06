<?php

namespace App\Entity;

use App\Repository\CelestialBodyTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CelestialBodyTypeRepository::class)]
#[ApiResource]
class CelestialBodyType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, CelestialBodies>
     */
    #[ORM\OneToMany(targetEntity: CelestialBodies::class, mappedBy: 'type')]
    private Collection $celestialBodies;

    public function __construct()
    {
        $this->celestialBodies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
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
    public function getCelestialBodies(): Collection
    {
        return $this->celestialBodies;
    }

    public function addCelestialBody(CelestialBodies $celestialBody): static
    {
        if (!$this->celestialBodies->contains($celestialBody)) {
            $this->celestialBodies->add($celestialBody);
            $celestialBody->setType($this);
        }

        return $this;
    }

    public function removeCelestialBody(CelestialBodies $celestialBody): static
    {
        if ($this->celestialBodies->removeElement($celestialBody)) {
            // set the owning side to null (unless already changed)
            if ($celestialBody->getType() === $this) {
                $celestialBody->setType(null);
            }
        }

        return $this;
    }
}
