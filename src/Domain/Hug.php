<?php

declare(strict_types=1);

namespace Marcelot\Hugs\Domain;

final class Hug
{
    /** @var string */
    private $who;

    /** @var string */
    private $message;

    /** @var array */
    private $events = [];

    private function __construct(string $who, string $message)
    {
        $this->who = $who;
        $this->message = $message;

        $this->events[] = new BudSqueezed($who);
    }

    public static function squeeze(string $who, string $message): self
    {
        return new self($who, $message);
    }

    public function who(): string
    {
        return $this->who;
    }

    public function mouth(): void
    {
        echo $this->message;
    }

    public function releaseEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }
}
