<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Category\Renderer;

use LukasRyder\Notes\Category\Category;

interface RendererInterface
{
    public function render(Category $category): string;
}
