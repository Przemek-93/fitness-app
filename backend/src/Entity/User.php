<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Serializer\Groups({"json", "user"})
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "user"})
     * @Assert\Length(min = 5, max = 64, allowEmptyString=false)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "user"})
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=128)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "user"})
     * @Assert\Length(min = 5, max = 128, allowEmptyString=false)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users", fetch="EAGER")
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     * @Serializer\Type("App\Entity\Role")
     * @Serializer\Groups({"json", "user-role"})
     */
    private $role;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z', '', 'Y-m-d\TH:i:s\Z'>")
     * @Serializer\Groups({"json", "user"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=TrainingActivity::class, mappedBy="user", orphanRemoval=true)
     * @Serializer\Expose()
     * @Serializer\Type("ArrayCollection<App\Entity\TrainingActivity>")
     * @Serializer\Groups({"json", "user-trainingActivity"})
     */
    private $trainingActivities;

    public function __construct($username)
    {
        $this->username = $username;
        $this->trainingActivities = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): ?string
    {
        return null;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     *  @ORM\PrePersist
     */
    public function prePersistEvent(): void
    {
        $this->createdAt = new DateTime('NOW');
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|TrainingActivity[]
     */
    public function getTrainingActivities(): Collection
    {
        return $this->trainingActivities;
    }

    public function addTrainingActivity(TrainingActivity $trainingActivity): self
    {
        if (!$this->trainingActivities->contains($trainingActivity)) {
            $this->trainingActivities[] = $trainingActivity;
            $trainingActivity->setUser($this);
        }

        return $this;
    }

    public function removeTrainingActivity(TrainingActivity $trainingActivity): self
    {
        if ($this->trainingActivities->removeElement($trainingActivity)) {
            // set the owning side to null (unless already changed)
            if ($trainingActivity->getUser() === $this) {
                $trainingActivity->setUser(null);
            }
        }

        return $this;
    }
}
