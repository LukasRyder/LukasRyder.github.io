<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

enum SortingDirection: string
{
    case ASCENDING = 'asc';
    case DESCENDING = 'desc';
}
