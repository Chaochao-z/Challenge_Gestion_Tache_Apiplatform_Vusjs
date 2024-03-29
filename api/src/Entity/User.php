<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use App\Controller\RegisterController;
use App\Dto\UserUpdateDto;
use App\Dto\UserVerifyEmailDto;
use App\Repository\UserRepository;
use App\State\UserUpdateProcessor;
use App\State\UserVerifyEmailProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['username' => 'exact'])]

#[Get(
    security: 'is_granted("ROLE_ADMIN") or object == user'
)]
#[GetCollection(

)]
#[Post(
    uriTemplate: '/register',
    controller: RegisterController::class,
    denormalizationContext: [
        'groups' => ['user_register']
    ]
)]
#[Patch(
    uriTemplate: '/users/verify_email',
    input: UserVerifyEmailDto::class,
    output: User::class,
    processor: UserVerifyEmailProcessor::class,
    status: 204
)]

#[Patch(
    security: 'is_granted("ROLE_ADMIN") or object == user'
)]

#[Delete(
    security: 'is_granted("ROLE_ADMIN")'
)]

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user_register','user_get','user_collection'])]
    private ?int $id = null;

    #[Groups(['user_register','user_get','user_collection'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[Groups(['user_register','user_get','user_collection'])]
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
    #[Groups(['user_get','user_collection'])]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column]
    #[Groups(['user_get','user_collection'])]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user_register','user_get','user_collection'])]
    private ?string $mail = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: ListeTache::class,cascade: ['persist', 'remove'])]
    private Collection $LesLiestTaches;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: UserTache::class,cascade: ['persist', 'remove'])]
    private Collection $userTaches;

    #[ORM\Column]
    private ?bool $isVerified = null;

    public function __construct()
    {
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new \DateTimeImmutable());
        $this->LesLiestTaches = new ArrayCollection();
        $this->userTaches = new ArrayCollection();
        if($this->isVerified == null){
            $this->isVerified = false;
        }
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

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
