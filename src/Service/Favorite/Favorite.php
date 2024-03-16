<?php

namespace App\Service\Favorite;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class Favorite
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
        
    }

    public function handleFavorite(User $user): void
    {
        $this->manager
        ->getRepository(User::class)
        ->saveUser($user);
    }
}
