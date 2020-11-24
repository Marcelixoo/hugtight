<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Marcelot\Hugs\Domain\BudSqueezed;
use Marcelot\Hugs\Application\AnnounceSuperTightHug\AnnounceSuperTightHug;
use Marcelot\Hugs\Application\HugTight\HugTight;
use Marcelot\Hugs\Application\HugTight\HugTightHandler;
use Marcelot\Hugs\Infrastructure\Persistence\HugsInMemoryStorage;
use Marcelot\Hugs\Infrastructure\EventBus\SimpleEventDispatcher;
use Marcelot\Hugs\Infrastructure\EventBus\SimpleListenerProvider;

$command = new HugTight($argv[1], $argv[2]);

$storage = new HugsInMemoryStorage();
$handler = new HugTightHandler(
    new SimpleEventDispatcher(
        new SimpleListenerProvider([BudSqueezed::class => [new AnnounceSuperTightHug()]])
    ),
    $storage
);

$handler->handle($command);

$hugs = $storage->findAllFor($argv[1]);

echo "We already have " . count($hugs) . " hug(s) so far :D";
