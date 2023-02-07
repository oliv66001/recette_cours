<?php

namespace App\Form;

use App\Entity\Ingredient;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de l\'ingrédient',
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom de l\'ingrédient',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom d\'ingrédient'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de l\'ingrédient doit faire au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Le nom de l\'ingrédient doit faire au plus {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('price');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
