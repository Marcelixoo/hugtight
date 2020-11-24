<?php

declare(strict_types=1);

namespace Marcelot\Tests\Infrastructure\EventBus;

use PHPUnit\Framework\TestCase;
use Marcelot\Hugs\Infrastructure\EventBus\SimpleListenerProvider;

final class SimpleListenerProviderTest extends TestCase
{
    /** @test */
    public function it_returns_all_listeners_interested_in_a_given_event(): void
    {
        $event = new class() {
            public $name = "Happy hour just started";
        };

        $listenerOne = function () { echo "listener 1";};
        $listenerTwo = function () { echo "listener 2";};

        $this->assertEquals($listenerOne, $listenerTwo);

        $listeners = [
            get_class($event) => [
                $listenerOne,
                $listenerTwo,
            ]
        ];

        $listenerProvider = new SimpleListenerProvider($listeners);

        $this->assertEquals([$listenerOne, $listenerTwo], $listenerProvider->getListenersForEvent($event));
    }
}