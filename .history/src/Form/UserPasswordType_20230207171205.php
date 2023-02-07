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
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Votre mot de passe',
           
                'invalid_message' => 'Les mots de passe ne correspondent pas',
            ],
        ])
                 ->add('newPassword', PasswordType::class, [
                    'first_options' => [
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'label' => 'Mot de passe',
                        'label_attr' => [
                            'class' => 'form-label mt-4'
                        ],
                    ],
                        'second_options' => [
                            'attr' => [
                                'class' => 'form-control'
                            ],
                            'label' => 'Confirmation du mot de passe',
                            'label_attr' => [
                                'class' => 'form-label mt-4'
                            
        
                        ],
                   ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Modifier',
            ]);
    }
}
