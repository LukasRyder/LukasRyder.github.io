<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category\Renderer;

use Generator;
use LukasRyder\Notes\Category\Category;
use LukasRyder\Notes\Category\NodeInterface;
use LukasRyder\Notes\Category\ParentNodeInterface;
use LukasRyder\Notes\Note;

final class MarkdownRenderer implements RendererInterface
{
    private const DEFAULT_PADDING_CHARACTER = ' ';
    private const DEFAULT_PADDING_SIZE = 2;
    private const DEFAULT_LIST_ITEM_PREFIX = '- ';
    private const DEFAULT_ENCODE_SPACES = false;
    private const DEFAULT_HEADING_PREFIX = '#';

    public function __construct(
        private readonly string $paddingCharacter = self::DEFAULT_PADDING_CHARACTER,
        private readonly int $paddingSize = self::DEFAULT_PADDING_SIZE,
        private readonly string $listItemPrefix = self::DEFAULT_LIST_ITEM_PREFIX,
        private readonly bool $encodeSpaces = self::DEFAULT_ENCODE_SPACES,
        private readonly string $headingPrefix = self::DEFAULT_HEADING_PREFIX
    ) {}

    public function render(Category $category): string
    {
        $document = [];

        foreach ($category as $child) {
            if ($child instanceof ParentNodeInterface) {
                array_push($document, ...$this->renderHeading($child, 1));

                foreach ($child as $grandChild) {
                    array_push($document, ...$this->renderChild($grandChild, 0));
                }

                continue;
            }

            array_push($document, ...$this->renderChild($child, 0));
        }

        return implode(PHP_EOL, $document);
    }

    private function renderHeading(NodeInterface $node, int $level): Generator
    {
        yield sprintf(
            '%s %s',
            str_repeat($this->headingPrefix, $level),
            $node->getName()
        );
    }

    private function renderChild(NodeInterface $node, int $depth): Generator
    {
        if ($node instanceof Note) {
            return $this->renderNote($node, $depth);
        }

        if ($node instanceof Category) {
            return $this->renderCategory($node, $depth);
        }
    }

    private function createPadding(int $depth): string
    {
        return str_repeat(
            $this->paddingCharacter,
            $this->paddingSize * $depth
        );
    }

    private function createPrefix(int $depth): string
    {
        return $this->createPadding($depth) . $this->listItemPrefix;
    }

    private function renderCategory(Category $category, int $depth): Generator
    {
        yield $this->createPrefix($depth) . $category->getName();

        foreach ($category as $child) {
            yield from $this->renderChild($child, $depth + 1);
        }
    }

    private function renderNote(Note $note, int $depth): Generator
    {
        yield $this->createPrefix($depth) . sprintf(
            '[%s](%s)',
                $note->getName(),
                $this->encodeSpaces
                    ? str_replace(' ', '%20', $note->file->getPathname())
                    : $note->file->getPathname()
        );
    }
}
