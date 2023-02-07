<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recette', name: 'app_recipe', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }
}
