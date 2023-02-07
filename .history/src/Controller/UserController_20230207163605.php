<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'app_user.edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_security.login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_recipe');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()->getPlainPassword()('plainPassword'))) {
                $user = $form->getData();

                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'Votre profil a bien été modifié !');

                return $this->redirectToRoute('app_recipe');
            } else {
                $this->addFlash('danger', 'Votre mot de passe est incorrect !');
            }
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/utilisateur/edition-mot-de-passe/{id}', name: 'app_user.edit.Password', methods: ['GET', 'POST'])]
    public function editPassword(User $user, Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {
                $user->setPlainPassword(
                    $form->getData()['newPassword']
                );

                

                $this->addFlash('success', 'Votre mot de passe a bien été modifié !');
                
                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_recipe');
            } else {
                $this->addFlash('danger', 'Votre mot de passe est incorrect !');
            }
        }

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
