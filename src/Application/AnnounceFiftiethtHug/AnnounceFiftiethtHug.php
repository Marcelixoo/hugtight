<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Application\AnnounceFiftiethtHug;

use Marcelot\Hugs\Domain\BudSqueezed;
use Marcelot\Hugs\Domain\HugsStorage;

final class AnnounceFiftiethtHug
{
    /** @var HugsStorage */
    private $storage;

    public function __construct(HugsStorage $storage)
    {
        $this->storage = $storage;
    }
    public function __invoke(BudSqueezed $event)
    {
        $hugs = $this->storage->findAllFor($event->who);

        $shoutedName = strtoupper($event->who);

        if (count($hugs) === 50) {
            echo "\n\n************************ 50 HUGS TO {$shoutedName}\n\n";
        }
    }
}
