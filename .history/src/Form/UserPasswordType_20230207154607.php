<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class UserPasswordType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre mot de passe',
                    'minLength' => '8',
                    'maxLength' => '50',
                ],
                'label' => 'Votre mot de passe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
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
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Modifier',
            ]);
    }
}