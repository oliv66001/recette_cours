<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'app_security.login', methods: ['GET', 'POST'])]
    public function login(): Response
    {
       
        return $this->render('pages/security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    #[Route('/deconnexion', name: 'app_security.logout', methods: ['GET', 'POST'])]
    public function logout(): void
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
