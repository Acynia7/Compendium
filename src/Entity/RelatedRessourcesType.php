<?php

namespace App\Entity;

use App\Repository\RelatedRessourcesTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: RelatedRessourcesTypeRepository::class)]
#[ApiResource]
class RelatedRessourcesType
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
     * @var Collection<int, RelatedRessources>
     */
    #[ORM\OneToMany(targetEntity: RelatedRessources::class, mappedBy: 'type')]
    private Collection $relatedRessources;

    public function __construct()
    {
        $this->relatedRessources = new ArrayCollection();
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
            $relatedRessource->setType($this);
        }

        return $this;
    }

    public function removeRelatedRessource(RelatedRessources $relatedRessource): static
    {
        if ($this->relatedRessources->removeElement($relatedRessource)) {
            // set the owning side to null (unless already changed)
            if ($relatedRessource->getType() === $this) {
                $relatedRessource->setType(null);
            }
        }

        return $this;
    }
}
