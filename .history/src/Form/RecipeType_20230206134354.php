<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Repository\IngredientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RecipeType extends AbstractType
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
                new Assert\NotBlank([
                    'message' => 'Veuillez saisir un nom d\'ingrédient'
                ]),
                new Assert\Length([
                    'min' => 2,
                    'minMessage' => 'Le nom de l\'ingrédient doit faire au moins {{ limit }} caractères',
                    'max' => 50,
                    'maxMessage' => 'Le nom de l\'ingrédient doit faire au plus {{ limit }} caractères'
                ])
            ]
        ])
        ->add('time', IntegerType::class, [
            'attr' => [
                'placeholder' => 'Temps de préparation',
                'class' => 'form-control',
                'min' => '1',
                'max' => '1440'
            ],
            'label' => 'Temps de préparation (en minutes)',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Positive([
                    'message' => 'Veuillez saisir un temps de préparation positif'
                ]),
                new Assert\LessThan(1441)
            ],
        ])
        ->add('nbPeople', IntegerType::class, [
            'attr' => [
                'placeholder' => 'Nombre de personnes',
                'class' => 'form-control',
                'min' => '1',
                'max' => '50'
            ],
            'label' => 'Nombre de personnes',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Positive([
                    'message' => 'Veuillez saisir un nombre de personnes positif'
                ]),
                new Assert\LessThan(51)
            ],
        ])
        ->add('difficulty', RangeType::class, [
            'attr' => [
                'placeholder' => 'Difficulté',
                'class' => 'form-range',
                'min' => '1',
                'max' => '5'
            ],
            'label' => 'Difficulté',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\Positive([
                    'message' => 'Veuillez saisir une difficulté positive'
                ]),
                new Assert\LessThan(6)
            ]
        ])
        ->add('description', TextareaType::class, [
            'attr' => [
                'placeholder' => 'Description de la recette',
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '500'
            ],
            'label' => 'Description',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez saisir une description'
                ]),
            ],
        ])
        ->add('price', MoneyType::class, [
            'attr' => [
                'placeholder' => 'Prix de l\'ingrédient ',
                'class' => 'form-control',
                'min' => '0',
                'max' => '1000'
            ],
            'label' => 'Prix de l\'ingrédient en ',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                // Montan max
                new Assert\LessThan(1001),
                // Montant positif
                new Assert\Positive([
                    'message' => 'Le prix de l\'ingrédient doit être positif'
                ]),
                
            ],
        ])

        ->add('isFavorite', CheckboxType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Favoris ?',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotNull([
                    'message' => 'Veuillez saisir une valeur'
                ]),
            ]
            ])

            ->add('ingredients' , EntityType::class, [
                'class' => Ingredient::class,
               'query_builder' => function (IngredientRepository $r) {
                    return $r->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                },
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir un ingrédient'
                    ]),
                ]
            ])
            ->add('submit', SubmitType::class)
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-dark mt-4'
            ],
            'label' => 'Ajouter l\'ingrédient'
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
