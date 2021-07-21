<?php

namespace App\User\Model;

use App\User\Entity\User;
use App\Common\Model\IEntity;
use App\Common\Model\IMapperModel;

class UserModel implements IMapperModel
{
    private string $username;
    private array $roles;
    private UserProfileModel $profile;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getProfile(): UserProfileModel
    {
        return $this->profile;
    }

    public function setProfile(UserProfileModel $profile): void
    {
        $this->profile = $profile;
    }

    public static function fromEntity(IEntity|User $entity): UserModel|IMapperModel
    {
        $model = new self();

        $model->setUsername($entity->getUserIdentifier());
        $model->setRoles($entity->getRoles());
        $model->setProfile(UserProfileModel::fromEntity($entity->getProfile()));

        return $model;
    }
}
