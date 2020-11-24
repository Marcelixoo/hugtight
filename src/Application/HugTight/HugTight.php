<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Application\HugTight;

final class HugTight
{
    /** @var string */
    public $who;

    /** @var string */
    public $specialMessage;

    public function __construct(
        string $who = "Marcelinhozinho",
        string $specialMessage = "No special message :/"
    ) {
        $this->who = $who;
        $this->specialMessage = $specialMessage;
    }
}
