<?php

declare(strict_types=1);

namespace LukasRyder\Notes;

interface NoteFactoryInterface
{
    public function create(string $path): Note;
}
