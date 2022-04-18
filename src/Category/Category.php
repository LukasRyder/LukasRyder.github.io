<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category;

use LukasRyder\Notes\Sorter\Context;
use LukasRyder\Notes\Sorter\ContextInterface;
use LukasRyder\Notes\Sorter\SortableInterface;
use LukasRyder\Notes\Sorter\SorterInterface;
use RecursiveIterator;

final class Category implements ParentNodeInterface, SortableInterface
{
    private array $children = [];

    public function __construct(private readonly string $name) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function current(): ?NodeInterface
    {
        return current($this->children) ?: null;
    }

    public function next(): void
    {
        next($this->children);
    }

    public function key(): ?string
    {
        return key($this->children);
    }

    public function valid(): bool
    {
        return $this->current() !== null;
    }

    public function rewind(): void
    {
        reset($this->children);
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }

    public function getChildren(): ?RecursiveIterator
    {
        return $this;
    }

    public function addChild(NodeInterface $child): void
    {
        $this->children[$child->getName()] = $child;
    }

    public function getChild(string $name): ?NodeInterface
    {
        return $this->children[$name] ?? null;
    }

    public function merge(ParentNodeInterface $other): void
    {
        foreach ($other as $child) {
            if (!$child instanceof NodeInterface) {
                continue;
            }

            $sibling = $this->getChild($child->getName());

            if (!$sibling instanceof ParentNodeInterface) {
                $this->addChild($child);
                continue;
            }

            if ($child instanceof ParentNodeInterface) {
                $sibling->merge($child);
            }
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'children' => array_values($this->children)
        ];
    }

    /** @noinspection PhpUnnecessaryStaticReferenceInspection */
    public function sort(
        SorterInterface $sorter,
        ?ContextInterface $context = null
    ): static {
        $result = new self($this->getName());

        $context?->push($this);
        $context ??= new Context();

        $children = array_map(
            fn (NodeInterface $node) => $node instanceof SortableInterface
                ? $node->sort($sorter, $context)
                : $node,
            array_values($this->children)
        );

        foreach ($sorter->sort($children, $context) as $node) {
            $result->addChild($node);
        }

        $context->pop();

        return $result;
    }
}
