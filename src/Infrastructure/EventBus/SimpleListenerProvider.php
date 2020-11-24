<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Infrastructure\EventBus;

use Webmozart\Assert\Assert;
use Psr\EventDispatcher\ListenerProviderInterface;

final class SimpleListenerProvider implements ListenerProviderInterface
{
    /** @var array */
    private $listenersByEventName = [];

    public function __construct(array $listenersPerEvent)
    {
        Assert::isMap($listenersPerEvent);

        foreach ($listenersPerEvent as $eventClass => $listenersForEvent) {
            Assert::isArray($listenersForEvent);
            Assert::classExists($eventClass);

            foreach ($listenersForEvent as $listener) {
                Assert::isCallable($listener);

                $this->$listenersByEventName[$eventClass][] = $listenersForEvent;
            }
        }
    }

    public function getListenersForEvent(object $event): iterable
    {
        $eventClass = get_class($event);

        if (array_key_exists($eventClass, $this->$listenersByEventName)) {
            return $this->$listenersByEventName[$eventClass];
        }

        return [];
    }
}
