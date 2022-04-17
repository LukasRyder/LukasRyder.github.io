<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Validator;

use LukasRyder\Notes\Note;

interface ValidatorInterface
{
    public function validates(Note $note): bool;
}
