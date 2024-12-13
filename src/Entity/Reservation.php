<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[UniqueEntity(
    fields: ['date', 'timeSlot'],
    message: 'Cette plage horaire est déjà réservée pour cette date.'
)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotNull(message: 'La date et l\'heure ne doivent pas être nulles.')]
    #[Assert\GreaterThanOrEqual(
        'now +1 day',
        message: 'Les réservations doivent se faire au moins 24 heures à l\'avance.'
    )]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotNull(message: 'La plage horaire ne doit pas être nulle.')]
    private $timeSlot;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotNull(message: 'Le nom de l\'événement ne doit pas être nul.')]
    private $eventName;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTimeSlot(): ?string
    {
        return $this->timeSlot;
    }

    public function setTimeSlot(string $timeSlot): static
    {
        $this->timeSlot = $timeSlot;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): static
    {
        $this->eventName = $eventName;

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