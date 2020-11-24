<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Domain;

final class BudSqueezed
{
    /** @var string */
    public $who;

    public function __construct(string $who)
    {
        $this->who = $who;
    }
}
