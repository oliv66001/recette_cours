<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre nom',
                    'minLength' => '2',
                    'maxLength' => '50',
                ],
                'label' => 'Full name',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Saisissez votre nom',
                    ]),
                    new Assert\Length([
                        'min' => '2',
                        'minMessage' => 'Votre nom doit comporter {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => '50',
                    ]),
                ],
            ])
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre pseudo',
                    'minLength' => '2',
                    'maxLength' => '50',
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length([
                        'min' => '2',
                        'minMessage' => 'Votre pseudo doit comporter {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => '50',
                    ])
                ],
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre email',
                    'minLength' => '2',
                    'maxLength' => '100',
                ],
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Saisissez votre email',
                    ]),
                    new Assert\Email([
                        'message' => 'Saisissez un email valide',
                    ]),
                    new Assert\Length([
                        'min' => '2',
                        'minMessage' => 'Votre email doit comporter {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => '180',
                    ]),
                ],
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
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
                    'invalid_message' => 'Les mots de passe ne correspondent pas',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
