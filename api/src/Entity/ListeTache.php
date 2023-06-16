<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ListeTacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeTacheRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['user_id' => 'exact'])]

class ListeTache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $titre = null;

    #[ORM\Column(length: 7000)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'LesLiestTaches')]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'listeTache', targetEntity: Tache::class,cascade: ['persist', 'remove'])]
    private Collection $LesTaches;

    public function __construct()
    {
        $this->LesTaches = new ArrayCollection();
        if ($this->createdAt == null)
        {
            $this->createdAt = new \DateTimeImmutable();
        }
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getLesTaches(): Collection
    {
        return $this->LesTaches;
    }

    public function addLesTach(Tache $lesTach): self
    {
        if (!$this->LesTaches->contains($lesTach)) {
            $this->LesTaches->add($lesTach);
            $lesTach->setListeTache($this);
        }

        return $this;
    }

    public function removeLesTach(Tache $lesTach): self
    {
        if ($this->LesTaches->removeElement($lesTach)) {
            // set the owning side to null (unless already changed)
            if ($lesTach->getListeTache() === $this) {
                $lesTach->setListeTache(null);
            }
        }

        return $this;
    }
}
