<?php

namespace App\Common\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return $this->respond(
        );
    }
}
