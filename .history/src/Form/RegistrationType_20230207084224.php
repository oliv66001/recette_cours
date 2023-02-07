<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
                    'placeholder' => 'Votre nom',
                    'minLength' => '2',
                    'maxLength' => '50',
                ],
                'label' => 'Full name',
                'label_attr' => [
                    'class' => 'form_label'
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
                    'placeholder' => 'Votre pseudo',
                    'minLength' => '2',
                    'maxLength' => '50',
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\Length([
                        'min' => '2',
                        'minMessage' => 'Votre pseudo doit comporter {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => '50',])
                ],
            ])
            
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Votre email',
                    'minLength' => '2',
                    'maxLength' => '50',
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form_label'
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
                        'max' => '50',]),
                ],
                ])
            
            ->add('password')
            ->add('submit', SubmitType::class, [
                'label' => 'Register'
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
