<?php

namespace App\Form;

use App\Entity\Ingredient;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom de l\'ingrédient',
                    'class' => 'form-control'
                    'minlength' => 2,
                    'maxlength' => 50
                ],
            'label' => 'Nom de l\'ingrédient',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
            
            ])
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
