<?php

namespace App\Admin\Controller;

use App\User\Entity\User;
use App\Admin\Type\UserType;
use App\Common\Data\Pageable;
use App\User\Service\UserService;
use App\Common\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route(path: '', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $form = $this->buildForm(UserType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respondInvalidForm($form);
        }

        /* @var $user User */
        $user = $form->getData();
        $user->getProfile()->setUser($user);

        $this->userService->create($user);

        return $this->respond();
    }
}
