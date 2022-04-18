<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Validator;

use LukasRyder\Notes\Note;

class UniqueTagDepthValidator implements ValidatorInterface
{
    private const CATEGORY_SEPARATOR = '/';

    public function __construct(
        private readonly string $pathSeparator = self::CATEGORY_SEPARATOR
    ) {}

    public function validates(Note $note): bool
    {
        $paths = array_map(
            fn (string $path) => explode($this->pathSeparator, $path),
            $note->frontMatter->tags
        );

        $depths = array_map(count(...), $paths);

        return count(array_unique($depths, SORT_NUMERIC)) === count($depths);
    }
}
