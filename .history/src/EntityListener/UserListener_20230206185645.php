<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
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
        $user->setPassword(password_hash($user->getPlainPassword(), PASSWORD_BCRYPT));

    }
}