<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Marcelot\Hugs\Domain\BudSqueezed;
use Marcelot\Hugs\Application\AnnounceFiftiethtHug\AnnounceFiftiethtHug;
use Marcelot\Hugs\Application\AnnounceSuperTightHug\AnnounceSuperTightHug;
use Marcelot\Hugs\Application\HugTight\HugTight;
use Marcelot\Hugs\Application\HugTight\HugTightHandler;
use Marcelot\Hugs\Infrastructure\Persistence\HugsInMemoryStorage;
use Marcelot\Hugs\Infrastructure\EventBus\SimpleEventDispatcher;
use Marcelot\Hugs\Infrastructure\EventBus\SimpleListenerProvider;

$who = $argv[1];
$message = $argv[2];
$intervalBetweenHugsInSeconds = $argv[3] ? (int) $argv[3] : 1;

$storage = new HugsInMemoryStorage();
$handler = new HugTightHandler(
    new SimpleEventDispatcher(
        new SimpleListenerProvider([
            BudSqueezed::class => [
                new AnnounceSuperTightHug(),
                new AnnounceFiftiethtHug($storage),
            ]
        ])
    ),
    $storage
);

foreach (range(2, 100) as $i) {
    $handler->handle(new HugTight($who, "{$message}! {$i} bisous *o*"));
    sleep($intervalBetweenHugsInSeconds);
}

$hugs = $storage->findAllFor($argv[1]);

echo "We have " . count($hugs) . " hug(s) so far :D";
