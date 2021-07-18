<?php

namespace App\User\Model;

use App\User\Entity\User;

class UserModel
{
    private string $username;
    private array $roles;

    public function __construct(User $user)
    {
        $this->username = $user->getUserIdentifier();
        $this->roles = $user->getRoles();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
