<?php

namespace App\Admin\Controller;

use App\Common\Data\Pageable;
use App\User\Service\UserService;
use App\Common\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/admin/user')]
class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route(path: '', methods: ['GET'])]
    public function getAll(Pageable $pageable): Response
    {
        return $this->respond($this->userService->getAllByPagination($pageable));
    }
}
