<?php

namespace App\Admin\Type;

use App\User\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('last_name', TextType::class, [
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('middle_name', TextType::class)
            ->add('phone', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '#998\d{9}#',
                        'message' => 'invalid username',
                    ]),
                ],
            ])
            ->add('email', EmailType::class)
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}
