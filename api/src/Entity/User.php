<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\RegisterController;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource]
#[Post(
    uriTemplate: '/register',
    controller: RegisterController::class,
    denormalizationContext: [
        'groups' => ['user_register']
    ]
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user_register'])]
    private ?int $id = null;

    #[Groups(['user_register'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[Groups(['user_register'])]
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['user_register'])]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Token = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $token_echeance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_register'])]
    private ?string $mail = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: ListeTache::class)]
    private Collection $LesLiestTaches;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: UserTache::class)]
    private Collection $userTaches;

    public function __construct()
    {
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new \DateTimeImmutable());
        $this->LesLiestTaches = new ArrayCollection();
        $this->userTaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(?string $Token): self
    {
        $this->Token = $Token;

        return $this;
    }

    public function getTokenEcheance(): ?\DateTimeInterface
    {
        return $this->token_echeance;
    }

    public function setTokenEcheance(?\DateTimeInterface $token_echeance): self
    {
        $this->token_echeance = $token_echeance;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, ListeTache>
     */
    public function getLesLiestTaches(): Collection
    {
        return $this->LesLiestTaches;
    }

    public function addLesLiestTach(ListeTache $lesLiestTach): self
    {
        if (!$this->LesLiestTaches->contains($lesLiestTach)) {
            $this->LesLiestTaches->add($lesLiestTach);
            $lesLiestTach->setUserId($this);
        }

        return $this;
    }

    public function removeLesLiestTach(ListeTache $lesLiestTach): self
    {
        if ($this->LesLiestTaches->removeElement($lesLiestTach)) {
            // set the owning side to null (unless already changed)
            if ($lesLiestTach->getUserId() === $this) {
                $lesLiestTach->setUserId(null);
            }
        }

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
            $userTach->setUserId($this);
        }

        return $this;
    }

    public function removeUserTach(UserTache $userTach): self
    {
        if ($this->userTaches->removeElement($userTach)) {
            // set the owning side to null (unless already changed)
            if ($userTach->getUserId() === $this) {
                $userTach->setUserId(null);
            }
        }

        return $this;
    }
}
