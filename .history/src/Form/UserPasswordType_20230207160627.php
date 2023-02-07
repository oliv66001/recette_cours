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
    public function buildform(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Votre mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'second_options' => [
                        'label' => 'Confirmez votre mot de passe',
                        'label_attr' => [
                            'class' => 'form-label mt-4'
                        ],
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Votre mot de passe',
                        'minLength' => '8',
                        'maxLength' => '50',
                    ],
                    'constraints' => [
                        new Assert\NotBlank([
                            'message' => 'Saisissez votre mot de passe',
                        ]),
                        new Assert\Length([
                            'min' => '8',
                            'minMessage' => 'Votre mot de passe doit comporter {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => '50',
                        ]),
                    ],
                ],
            ])
                ->add('newPassword', PasswordType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'label' => 'Votre nouveau mot de passe',
                        'placeholder' => 'Votre nouveau mot de passe',
                        'minLength' => '8',
                        'maxLength' => '50',
                    ],
                    'label' => 'Votre nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'constraints' => [
                        new Assert\NotBlank([
                            'message' => 'Saisissez votre nouveau mot de passe',
                        ]),
                        new Assert\Length([
                            'min' => '8',
                            'minMessage' => 'Votre nouveau mot de passe doit comporter {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => '50',
                        ]),
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