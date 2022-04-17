<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category\Path;

use Generator;
use LukasRyder\Notes\Note;

final class LongestPathGenerator implements PathGeneratorInterface
{
    private const CATEGORY_SEPARATOR = '/';

    public function __construct(
        private readonly string $pathSeparator = self::CATEGORY_SEPARATOR
    ) {}

    public function generate(Note $note): Generator
    {
        if (count($note->frontMatter->tags) === 0) {
            return;
        }

        $paths = array_map(
            fn (string $path) => explode($this->pathSeparator, $path),
            $note->frontMatter->tags
        );

        usort(
            $paths,
            static fn (array $a, array $b) => count($a) <=> count($b)
        );

        yield array_pop($paths);
    }
}
