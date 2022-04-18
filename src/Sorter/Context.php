<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

use LukasRyder\Notes\Category\NodeInterface;

class Context implements ContextInterface
{
    private array $stack = [];

    public function push(NodeInterface $node): void
    {
        $this->stack[] = $node->getName();
    }

    public function pop(): void
    {
        array_pop($this->stack);
    }

    public function getStack(): array
    {
        return $this->stack;
    }
}
