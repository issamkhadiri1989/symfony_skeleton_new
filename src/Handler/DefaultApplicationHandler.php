<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Application;

final class DefaultApplicationHandler extends AbstractApplicationHandler
{
    public function handle(Application $application): void
    {
        $application->setPostedAt(new \DateTimeImmutable());

        $this->workflow->apply($application, 'post_application');

        $this->persister->persist($application);
    }
}

