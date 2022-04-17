<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category;

use RecursiveIterator;

interface ParentNodeInterface extends RecursiveIterator, NodeInterface
{
    public function addChild(NodeInterface $child): void;

    public function merge(ParentNodeInterface $other): void;
}
