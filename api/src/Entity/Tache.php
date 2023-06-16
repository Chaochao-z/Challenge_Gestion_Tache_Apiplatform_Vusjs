<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Elasticsearch\Filter\OrderFilter;


#[ORM\Entity(repositoryClass: TacheRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['listeTache' => 'exact','titre'=>'exact','propid' => 'exact'])]
#[ApiFilter(OrderFilter::class, properties: ['priotity' => 'asc', 'date_echeance' => 'asc'])]


class Tache
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
    private ?int $priotity = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_echeance = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: UserTache::class,cascade: ['persist', 'remove'])]
    private Collection $userTaches;

    #[ORM\ManyToOne(inversedBy: 'LesTaches')]
    private ?ListeTache $listeTache = null;

    #[ORM\Column(nullable: true)]
    private ?int $propid = null;

    public function __construct()
    {
        $this->userTaches = new ArrayCollection();
        if ($this->createdAt == null)
        {
            $this->createdAt = new \DateTimeImmutable();
        }
        $this->updatedAt = new  \DateTimeImmutable();
        if ($this->status == null)
        {
            $this->status = 1;
        }
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

    public function getPriotity(): ?int
    {
        return $this->priotity;
    }

    public function setPriotity(int $priotity): self
    {
        $this->priotity = $priotity;

        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->date_echeance;
    }

    public function setDateEcheance(?\DateTimeInterface $date_echeance): self
    {
        $this->date_echeance = $date_echeance;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    public function setUserTache(?UserTache $userTache): self
    {
        $this->userTache = $userTache;

        return $this;
    }

    /**
     * @return Collection<int, UserTache>
     */
    public function getUserTaches(): Collection
    {
        return $this->userTaches;
    }

    public function addUserTach(UserTache $userTach): self
    {
        if (!$this->userTaches->contains($userTach)) {
            $this->userTaches->add($userTach);
            $userTach->setTache($this);
        }

        return $this;
    }

    public function removeUserTach(UserTache $userTach): self
    {
        if ($this->userTaches->removeElement($userTach)) {
            // set the owning side to null (unless already changed)
            if ($userTach->getTache() === $this) {
                $userTach->setTache(null);
            }
        }

        return $this;
    }

    public function getListeTache(): ?ListeTache
    {
        return $this->listeTache;
    }

    public function setListeTache(?ListeTache $listeTache): self
    {
        $this->listeTache = $listeTache;

        return $this;
    }

    public function getPropid(): ?int
    {
        return $this->propid;
    }

    public function setPropid(?int $propid): self
    {
        $this->propid = $propid;

        return $this;
    }
}
