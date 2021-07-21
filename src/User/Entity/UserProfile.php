<?php

namespace App\User\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use App\User\Repository\UserProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserProfileRepository::class)]
class UserProfile
{
    #[
        ORM\Id,
        ORM\OneToOne(inversedBy: 'profile', targetEntity: User::class),
        ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')
    ]
    private User $user;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $first_name;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $middle_name = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $last_name;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTime $birthday = null;

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function setMiddleName(?string $middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getBirthday(): ?DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
