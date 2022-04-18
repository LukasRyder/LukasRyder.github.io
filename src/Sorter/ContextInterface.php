<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

use LukasRyder\Notes\Category\NodeInterface;

interface ContextInterface
{
    public function push(NodeInterface $node): void;

    public function pop(): void;

    public function getStack(): array;
}
