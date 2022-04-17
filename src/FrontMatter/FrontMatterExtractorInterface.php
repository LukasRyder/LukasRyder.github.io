<?php

declare(strict_types=1);

namespace LukasRyder\Notes\FrontMatter;

use SplFileInfo;

interface FrontMatterExtractorInterface
{
    public function extract(SplFileInfo $file): FrontMatter;
}
