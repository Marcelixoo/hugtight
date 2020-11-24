<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Application\HugTight;

use Marcelot\Hugs\Domain\Hug;
use Marcelot\Hugs\Domain\HugsStorage;
use Psr\EventDispatcher\EventDispatcherInterface;

final class HugTightHandler
{
    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var HugsStorage */
    private $hugsStorage;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        HugsStorage $hugsStorage
    ) {
        $this->dispatcher = $dispatcher;
        $this->hugsStorage = $hugsStorage;
    }

    public function handle(HugTight $command): void
    {
        $newHug = Hug::squeeze($command->who, $command->specialMessage);

        $newHug->mouth();

        $this->hugsStorage->save($newHug);

        foreach ($newHug->releaseEvents() as $eventToDispatch) {
            $this->dispatcher->dispatch($eventToDispatch);
        }
    }
}
