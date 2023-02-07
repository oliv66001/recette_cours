<?php

namespace App\Controller;


use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @param RecipeRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/recette', name: 'app_recipe', methods: ['GET'])]
    public function index(RecipeRepository $repository,  PaginatorInterface $paginator, Request $request): Response
    {

        $recipes = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('pages/recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * Undocumented function
     *
     * @param RecipeRepository $repository
     * @param string $slug
     * @return Response
     */
    #[Route('/recette/creation', name: 'app_recipe.new', methods: ['GET'])]
    public function new(): Response
    {
        $recipe = $repository->findOneBy(['slug' => $slug]);
        return $this->render('pages/recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
