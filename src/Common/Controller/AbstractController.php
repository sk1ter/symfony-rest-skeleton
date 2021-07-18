<?php

namespace App\Common\Controller;

use App\User\Entity\User;
use App\Common\Model\InvalidFormModel;
use Symfony\Component\Form\Form;
use App\Common\Model\InvalidFormItemModel;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;

abstract class AbstractController extends AbstractFOSRestController
{
    protected function buildForm(string $type, $data = null, array $options = []): FormInterface
    {
        $options = array_merge($options, [
            'csrf_protection' => false,
        ]);

        return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
    }

    protected function respond($data = null, int $statusCode = Response::HTTP_OK): Response
    {
        if ($data === null && $statusCode !== Response::HTTP_CREATED) {
            $statusCode = Response::HTTP_NO_CONTENT;
        }

        return $this->handleView($this->view($data, $statusCode));
    }

    protected function respondInvalidForm(FormInterface $form): Response
    {
        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

        $errors = [];

        if ($form->getErrors()->count() > 0) {
            foreach ($form->getErrors(true) as $error) {
                $message = $error->getMessage() . ' ' . implode(', ', $error->getMessageParameters());
                $errors[] = new InvalidFormItemModel('', $message);
            }
        } else {
            foreach ($form as $fieldName => $formField) {
                /* @var Form $formField */
                foreach ($formField->getErrors(true) as $error) {
                    $errors[] = new InvalidFormItemModel($fieldName, $error->getMessage());
                }
            }
        }

        return $this->respond(
            new InvalidFormModel(
                1000,
                'validation error',
                $errors
            ),
            $statusCode
        );
    }

    /**
     * @return UserInterface|null|User
     */
    protected function getUser(): UserInterface|User|null
    {
        return parent::getUser();
    }
}
