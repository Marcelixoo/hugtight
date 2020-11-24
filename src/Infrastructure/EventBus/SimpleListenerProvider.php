<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Infrastructure\EventBus;

use Webmozart\Assert\Assert;
use Psr\EventDispatcher\ListenerProviderInterface;

final class SimpleListenerProvider implements ListenerProviderInterface
{
    private $listenersByEvents;

    public function __construct(array $listenersPerEvent)
    {
        Assert::isMap($listenersPerEvent);

        foreach ($listenersPerEvent as $eventClass => $listenersForEvent) {
            Assert::isArray($listenersForEvent);
            Assert::classExists($eventClass);

            foreach ($listenersForEvent as $listenersForEvent) {
                Assert::isCallable($listenersForEvent);

                $this->listenersByEvents[$eventClass][] = $listenersForEvent;
            }
        }
    }

    public function getListenersForEvent(object $event): iterable
    {
        $eventClass = get_class($event);

        if (array_key_exists($eventClass, $this->listenersByEvents)) {
            return $this->listenersByEvents[$eventClass];
        }

        return [];
    }
}
