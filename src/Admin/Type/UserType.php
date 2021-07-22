<?php

namespace App\Admin\Type;

use App\Common\Enum\Role;
use App\User\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Regex([
                        'pattern' => '#998\d{9}#',
                        'message' => 'invalid username',
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices'     => Role::toArray(),
                'multiple'    => true,
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('password', TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'min' => 8,
                    ]),
                ],
            ])
            ->add('profile', UserProfileType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
