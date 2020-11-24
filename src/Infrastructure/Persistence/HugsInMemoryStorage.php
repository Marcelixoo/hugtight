<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Infrastructure\Persistence;

use Marcelot\Hugs\Domain\Hug;
use Marcelot\Hugs\Domain\HugsStorage;

final class HugsInMemoryStorage implements HugsStorage
{
    /** @var array */
    private $storage = [];

    public function findAllFor(string $who): array
    {
        if (!array_key_exists($who, $this->storage)) {
            return [];
        }

        return $this->storage[$who];
    }

    public function save(Hug $newHug): void
    {
        $this->storage[$newHug->who()][] = $newHug;
    }
}
