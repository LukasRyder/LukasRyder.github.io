<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

final class Config
{
    public function __construct(
        public readonly array $path,
        public readonly SortingProperty $property = SortingProperty::NAME,
        public readonly SortingDirection $direction = SortingDirection::ASCENDING
    ) {}

    public static function fromObject(object $config): self
    {
        return new self(
            path:      $config->path,
            property:  SortingProperty::from($config->property),
            direction: SortingDirection::from($config->direction)
        );
    }
}
