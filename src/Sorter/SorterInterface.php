<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

interface SorterInterface
{
    public function sort(array $entries, ContextInterface $context): array;
}
