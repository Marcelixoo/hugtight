<?php

declare(strict_types=1);

namespace Marcelot\Tests\Infrastructure\EventBus;

use stdClass;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\ListenerProviderInterface;
use Marcelot\Hugs\Infrastructure\EventBus\SimpleEventDispatcher;

final class SimpleEventDispatcherTest extends TestCase
{
    /** @var Watcher */
    private $watcher;

    /** @var SimpleEventDispatcher */
    private $dispatcher;

    public function setUp(): void
    {
        $this->watcher = new class() implements Watcher {
            private $dispatchedEvent;

            public function __invoke(object $event)
            {
                $this->dispatchedEvent = $event;
            }

            public function dispatchedEvent(): ?object
            {
                return $this->dispatchedEvent;
            }
        };

        $listenerProvider = $this->createMock(ListenerProviderInterface::class);

        $listenerProvider->method('getListenersForEvent')
            ->willReturn([$this->watcher]);

        $this->dispatcher = new SimpleEventDispatcher($listenerProvider);
    }

    /** @test */
    public function it_calls_all_listeners_with_correspondent_event_object(): void
    {
        $event = new stdClass();

        $event->name = "Let's hug!";

        $this->dispatcher->dispatch($event);

        $this->assertEquals($event, $this->watcher->dispatchedEvent());
    }

    /** @test */
    public function it_returns_unmodified_event_after_calling_all_listeners(): void
    {
        $event = new stdClass();

        $event->name = "Let's hug!";

        $fromDispatcher = $this->dispatcher->dispatch($event);

        $this->assertEquals($event, $fromDispatcher);
    }
}

interface Watcher
{
    public function dispatchedEvent(): ?object;
}