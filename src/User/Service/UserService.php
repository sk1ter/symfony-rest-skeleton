<?php

namespace App\User\Service;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private UserRepository $user_repository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepository $user_repository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->user_repository = $user_repository;
        $this->passwordHasher = $passwordHasher;
    }

    public function findById(int $id): ?User
    {
        return $this->user_repository->findOneBy(['id' => $id]);
    }

    public function findByUsername(string $username): ?User
    {
        return $this->user_repository->findOneBy(['username' => $username]);
    }

    public function findByIdOrFail(int $id): User
    {
        if (($user = $this->findById($id)) !== null) {
            return $user;
        }

        throw new NotFoundHttpException("user not found");
    }

    public function create(User $user): User
    {
        if ($this->user_repository->findByUsername($user->getUserIdentifier()) !== null) {
            throw new BadRequestHttpException('user already exists');
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
        return $this->user_repository->save($user);
    }

    public function changePassword(User $user): User
    {
        $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
        return $this->user_repository->save($user);
    }

    public function appendRole(User $user, string $role): User
    {
        $user->addRole($role);

        return $this->user_repository->save($user);
    }

    public function deleteRole(User $user, string $role): User
    {
        $user->removeRole($role);

        return $this->user_repository->save($user);
    }
}
