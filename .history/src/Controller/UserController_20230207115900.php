<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'app_user.edit')]
    public function edit(User $user): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_security_login');
        }

        if ($this->getUser() === $user) {
            return $this->redirectToRoute('app_recipe.index');
        }

        $form = $this->createForm(UserType::class, $user);

        return $this->render('pages/user/edit.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
