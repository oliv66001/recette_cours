<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Ingredient;
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
        for ($i = 0; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                       ->setPrice(mt_rand(1, 100) / 10);

        $manager->persist($ingredient);
    }
        $manager->flush();
    }

}