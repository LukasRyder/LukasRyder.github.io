<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category\Path;

use Generator;
use LukasRyder\Notes\Note;

interface PathGeneratorInterface
{
    public function generate(Note $note): Generator;
}
