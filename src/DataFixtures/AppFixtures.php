<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const COUNT_CATEGORY = 10; 

    private const COUNT_USERS = 40;

    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(self::COUNT_CATEGORY);

        UserFactory::createMany(self::COUNT_USERS);

        $manager->flush();
    }
}
