<?php

declare(strict_types=1);

namespace App\Handler;

use App\Persister\ApplicationPersisterInterface;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\Workflow\WorkflowInterface;

abstract class AbstractApplicationHandler implements ApplicationHandlerInterface
{
    public function __construct(
        protected ApplicationPersisterInterface $persister,
        #[Target('smartJobStateMachine')]
        protected WorkflowInterface $workflow,
    ) {
        
    }
}
