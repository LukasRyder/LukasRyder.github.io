<?php

declare(strict_types=1);

namespace LukasRyder\Notes;

use LukasRyder\Notes\Category\NodeInterface;
use LukasRyder\Notes\FrontMatter\FrontMatter;
use SplFileInfo;

final class Note implements NodeInterface
{
    public function __construct(
        public readonly SplFileInfo $file,
        public readonly FrontMatter $frontMatter
    ) {}

    public function getName(): string
    {
        return $this->frontMatter->title;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'path' => $this->file->getPathname()
        ];
    }
}
