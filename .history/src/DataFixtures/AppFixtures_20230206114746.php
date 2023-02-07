<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Generator;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // Ingredients
        $ingredients = [];
        for ($i = 0; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(1, 100) / 10);

            $ingredients[] = $ingredient;
            $manager->persist($ingredient);
        }


        //Recipe
        for ($j = 0; $j <= 50; $j++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->word())
                ->setTime(mt_rand(0, 1) == 1 ? mt_rand(1, 1440) : null)
                ->setNbPeople(mt_rand(0, 1) == 1 ? mt_rand(1, 50) : null)
                ->setDifficulty(mt_rand(0, 1) == 1 ? mt_rand(1, 5) : null)
                ->setDescription($this->faker->text(300))
                ->setPrice(mt_rand(1, 1000) / 10)
                ->setIsFavorite($this->faker->boolean())
                ->setCreatedAt($this->faker->dateTimeBetween('-6 months'))
                ->setUpdatedAt($this->faker->dateTimeBetween('-6 months'));
        }
        $manager->flush();
    }
}
