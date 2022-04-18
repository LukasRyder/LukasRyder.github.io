<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category;

use JsonSerializable;

interface NodeInterface extends JsonSerializable
{
    public function getName(): string;
}
