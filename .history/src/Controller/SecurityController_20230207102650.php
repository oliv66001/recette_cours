<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'app_security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/deconnexion', name: 'app_security.logout', methods: ['GET', 'POST'])]
    public function logout(): void
    {
    }

    #[Route('/inscription', name: 'app_security.registration', methods: ['GET', 'POST'])]
    public function registration(RegistrationType $registrationType): Response
    {
            $user = new User();
            $form = $this->createForm(RegistrationType::class, $user);

        return $this->render('pages/security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
