<?php

declare(strict_types=1);

namespace LukasRyder\Notes;

use LukasRyder\Notes\FrontMatter\FrontMatterExtractorInterface;
use SplFileInfo;

class NoteFactory implements NoteFactoryInterface
{
    public function __construct(
        private FrontMatterExtractorInterface $frontMatterExtractor
    ) {}

    public function create(string $path): Note
    {
        $file = new SplFileInfo($path);
        $frontMatter = $this->frontMatterExtractor->extract($file);

        return new Note(
            file: $file,
            frontMatter: $frontMatter
        );
    }
}
