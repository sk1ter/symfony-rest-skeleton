<?php

namespace App\Admin\Controller;

use App\Common\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/admin/default')]
class DefaultController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function index(): Response
    {
        return $this->respond(['status' => 'ok']);
    }
}
