<?php

namespace App\User\Controller;

use App\User\Model\UserModel;
use App\Common\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/user')]
class UserController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function info(): Response
    {
        return $this->respond(UserModel::fromEntity($this->getUser()));
    }
}
