<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPasswordType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Votre ancien mot de passe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre mot de passe',
                    'invalid_message' => 'Les mots de passe ne correspondent pas'
                ],
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Votre nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4',
                        'placeholder' => 'Votre nouveau mot de passe'
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Confirmation du nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4',
                        'placeholder' => 'Confirmation du nouveau mot de passe'
                    ]

                ],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark mt-4',
                ],
                'label' => 'Modifier',
            ]);
    }
}
