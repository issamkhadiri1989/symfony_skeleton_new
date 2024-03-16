<?php

namespace App\Persister;

use App\Entity\Application;

interface ApplicationPersisterInterface
{
    public function persist(Application  $application): void;
}
