<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Application\AnnounceSuperTightHug;

use Marcelot\Hugs\Domain\BudSqueezed;

final class AnnounceSuperTightHug
{
    public function __invoke(BudSqueezed $event)
    {
        $border = str_pad("", 50, "=");

        echo "\n\n{$border}\n";
        echo str_pad("Suuuuuuper tight hug to {$event->who}", 50, " ", STR_PAD_BOTH) . "\n";
        echo "{$border}\n\n";
    }
}
