<?php

declare(strict_types=1);

namespace LukasRyder\Notes\FrontMatter;

use DateTimeInterface;

final class FrontMatter
{
    public function __construct(
        public readonly string $title,
        public readonly array $tags,
        public DateTimeInterface $created,
        public DateTimeInterface $modified
    ) {}
}
