<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'app_user')]
    public function edit(): Response
    {
        return $this->render('pages/user/edit.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
