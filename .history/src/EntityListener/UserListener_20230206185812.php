<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public function prePersist(User $user): void
    {
        
    }

    public function preUpdate(User $user): void
    {
        
    }

    public function encodePassword  (User $user): void
    {
        if ($user->getPlainPassword() === null) {
            return;
        }
        $user->setPassword(
            $this->hasher->hashPassword($user, $user->getPlainPassword())
        );

    }
}