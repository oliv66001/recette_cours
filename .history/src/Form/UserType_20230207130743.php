<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
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
            'label' => 'Votre nom',
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
            'label' => 'Votre pseudo',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\length([
                    'min' => '2',
                    'minMessage' => 'Votre pseudo doit comporter {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => '50',
                ])
            ],
        ])

        ->add('plainPassword', PasswordType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Nouveau mot de passe',
            ],
            'label' => 'Votre mot de passe',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            
         
        ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'form-label btn btn-dark mt-4'
                ],
            
        ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
