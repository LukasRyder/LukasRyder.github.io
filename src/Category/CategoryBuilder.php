<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category;

use LukasRyder\Notes\Category\Path\LongestPathGenerator;
use LukasRyder\Notes\Category\Path\PathGeneratorInterface;
use LukasRyder\Notes\Note;
use LukasRyder\Notes\Sorter\SorterInterface;

final class CategoryBuilder
{
    private const DEFAULT_ROOT_CATEGORY = 'Index';

    /** @var array<int,Note> */
    private array $notes = [];

    public function __construct(
        private readonly SorterInterface $sorter,
        private readonly PathGeneratorInterface $pathGenerator = new LongestPathGenerator(),
        private readonly string $rootCategoryName = self::DEFAULT_ROOT_CATEGORY
    ) {}

    public function addNote(Note $note): void
    {
        $this->notes[] = $note;
    }

    public function create(): Category
    {
        $root = new Category($this->rootCategoryName);

        foreach ($this->notes as $note) {
            $this->createTree($root, $note);
        }

        return $root->sort($this->sorter);
    }

    private function createTree(Category $root, Note $note): void
    {
        foreach ($this->pathGenerator->generate($note) as $path) {
            $this->createNodeFromPath($root, $note, ...$path);
        }
    }

    private function createNodeFromPath(
        Category $parent,
        Note $note,
        string ...$path
    ): void {
        $name = array_shift($path);

        if (!is_string($name)) {
            $parent->addChild($note);
            return;
        }

        $category = new Category($name);
        $sibling = $parent->getChild($name);

        if ($sibling instanceof ParentNodeInterface) {
            $category->merge($sibling);
        }

        $parent->addChild($category);

        $this->createNodeFromPath($category, $note, ...$path);
    }
}
