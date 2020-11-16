<?php

namespace App\Entity;

use App\Repository\TrainingActivityRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TrainingActivityRepository::class)
 */
class TrainingActivity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="trainingActivities")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     * @Serializer\SerializedName("user")
     * @Serializer\Type("App\Entity\User")
     * @Serializer\Groups({"json", "trainigActivity-user"})
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("internalId")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("integer")
     */
    private $internalId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("string")
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("string")
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\SerializedName("reccurenceRule")
     * @Serializer\Type("string")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("string")
     */
    private $recurrenceRule;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\SerializedName("startTime")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z', '', 'Y-m-d\TH:i:s\Z'>")
     * @Serializer\Groups({"json", "trainingActivity"})
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\SerializedName("endTime")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z', '', 'Y-m-d\TH:i:s\Z'>")
     * @Serializer\Groups({"json", "trainingActivity"})
     */
    private $endTime;

    /**
     * @ORM\Column(type="boolean")
     * @Serializer\Expose()
     * @Serializer\SerializedName("isAllDay")
     * @Serializer\Type("boolean")
     * @Serializer\Groups({"json", "trainingActivity"})
     * @Assert\Type("boolean")
     */
    private $isAllDay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getInternalId()
    {
        return $this->internalId;
    }

    public function setInternalId($internalId): void
    {
        $this->internalId = $internalId;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location): void
    {
        $this->location = $location;
    }

    public function getRecurrenceRule()
    {
        return $this->recurrenceRule;
    }

    public function setRecurrenceRule($recurrenceRule): void
    {
        $this->recurrenceRule = $recurrenceRule;
    }

    public function getStartTime(): ?DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getIsAllDay(): ?bool
    {
        return $this->isAllDay;
    }

    public function setIsAllDay(bool $isAllDay): self
    {
        $this->isAllDay = $isAllDay;

        return $this;
    }
}
