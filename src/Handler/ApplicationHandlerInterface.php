<?php

namespace App\Handler;

use App\Entity\Application;

interface ApplicationHandlerInterface
{
    public function handle(Application $application): void;
}
