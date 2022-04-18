<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

interface SortableInterface
{
    public function sort(
        SorterInterface $sorter,
        ?ContextInterface $context = null
    ): static;
}
