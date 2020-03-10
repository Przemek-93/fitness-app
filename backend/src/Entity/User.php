<?php

namespace App\Entity;

use DateTime;
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
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z', '', 'Y-m-d\TH:i:s\Z'>")
     * @Serializer\Groups({"json", "user"})
     */
    private $createdAt;

    public function __construct($username)
    {
        $this->username = $username;
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
        return array('ROLE_USER');
    }

    public function eraseCredentials(): ?string
    {
        return null;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     *  @ORM\PrePersist
     */
    public function prePersistEvent()
    {
        $this->createdAt = new DateTime('NOW');
    }
}
