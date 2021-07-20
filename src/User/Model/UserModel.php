<?php

namespace App\User\Model;

use App\User\Entity\User;

class UserModel
{
    private string $username;
    private array $roles;
    private UserProfileModel $userProfile;

    public function __construct(User $user)
    {
        $this->username = $user->getUserIdentifier();
        $this->roles = $user->getRoles();
        $this->userProfile = new UserProfileModel($user->getUserProfile());
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getUserProfile(): UserProfileModel
    {
        return $this->userProfile;
    }
}
