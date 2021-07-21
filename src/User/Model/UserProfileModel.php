<?php

namespace App\User\Model;

use DateTime;
use App\Common\Model\IEntity;
use App\User\Entity\UserProfile;
use App\Common\Model\IMapperModel;
use JMS\Serializer\Annotation as Serializer;

class UserProfileModel implements IMapperModel
{
    private string $firstName;
    private string $lastName;
    private ?string $middleName;
    private ?string $phone;
    private ?string $email;

    /**
     * @Serializer\Exclude
     */
    private ?DateTime $birthday;

    public function setBirthday(?DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @Serializer\VirtualProperty()
     */
    public function getBirthday(): ?string
    {
        if ($this->birthday == null) {
            return null;
        }

        return $this->birthday->format('Y-m-d');
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;
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

    public static function fromEntity(IEntity|UserProfile $entity): IMapperModel|UserProfileModel
    {
        $model = new self();

        $model->setFirstName($entity->getFirstName());
        $model->setLastName($entity->getLastName());
        $model->setMiddleName($entity->getMiddleName());
        $model->setPhone($entity->getPhone());
        $model->setEmail($entity->getEmail());
        $model->setBirthday($entity->getBirthday());

        return $model;
    }
}
