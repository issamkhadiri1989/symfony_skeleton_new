<?php

namespace App\Persister;

use App\Entity\Application;
use Doctrine\ORM\EntityManagerInterface;

final class ApplicationDefaultPersister implements ApplicationPersisterInterface
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {
        
    }

    public function persist(Application $application): void
    {
        $this->manager->persist($application);
        $this->manager->flush();
    }
}
