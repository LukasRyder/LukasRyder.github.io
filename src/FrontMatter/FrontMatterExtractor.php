<?php

declare(strict_types=1);

namespace LukasRyder\Notes\FrontMatter;

use DateTimeImmutable;
use League\CommonMark\Extension\FrontMatter\FrontMatterParserInterface;
use SplFileInfo;

class FrontMatterExtractor implements FrontMatterExtractorInterface
{
    public function __construct(
        private FrontMatterParserInterface $parser
    ) {}

    public function extract(SplFileInfo $file): FrontMatter
    {
        $handle = $file->openFile('r');
        $markdown = $handle->fread($file->getSize());
        $data = (array)$this->parser->parse($markdown)->getFrontMatter();

        return new FrontMatter(
            title: $data['title'] ?? '',
            tags: $data['tags'] ?? [],
            created: new DateTimeImmutable($data['created']),
            modified: new DateTimeImmutable($data['modified'])
        );
    }
}
