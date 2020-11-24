<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Domain;

interface HugsStorage
{
    /** @var Hug[] */
    public function findAllFor(string $who): array;
    public function save(Hug $newHug): void;
}
