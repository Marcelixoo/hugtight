<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Infrastructure\EventBus;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

final class SimpleEventDispatcher implements EventDispatcherInterface
{
    /** @var ListenerProviderInterface */
    private $listenersProvider;

    public function __construct(ListenerProviderInterface $provider)
    {
        $this->listenersProvider = $provider;
    }

    public function dispatch(object $event): object
    {
        $listenersForEvent = $this->listenersProvider->getListenersForEvent($event);

        foreach ($listenersForEvent as $listenerToCall) {
            call_user_func_array($listenerToCall, [$event]);
        }

        return $event;
    }
}
