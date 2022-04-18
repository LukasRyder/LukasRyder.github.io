<?php

declare(strict_types=1);

namespace LukasRyder\Notes\Sorter;

use JsonException;
use LukasRyder\Notes\Category\NodeInterface;

final class ConfigurableSorter implements SorterInterface
{
    private readonly array $configs;

    public function __construct(
        private readonly Config $defaultConfig = new Config([]),
        Config ...$configs
    ) {
        $this->configs = $configs;
    }

    public function sort(array $entries, ContextInterface $context): array
    {
        $configs = array_filter(
            $this->configs,
            static fn (Config $config) => $config->path === $context->getStack()
        );
        $configs[] = $this->defaultConfig;

        /** @var Config $config */
        [$config] = $configs;

        usort(
            $entries,
            $this->applyDirection(
                fn (NodeInterface $a, NodeInterface $b) => (
                    $this->normalizeNode($a, $config)
                    <=> $this->normalizeNode($b, $config)
                ),
                $config
            )
        );

        return $entries;
    }

    private function applyDirection(callable $sorter, Config $config): callable
    {
        return match ($config->direction) {
            SortingDirection::ASCENDING => static fn () => $sorter(...func_get_args()),
            SortingDirection::DESCENDING => static fn () => -1 * $sorter(...func_get_args())
        };
    }

    private function normalizeNode(NodeInterface $node, Config $config): mixed
    {
        return match ($config->property) {
            SortingProperty::NAME => $node->getName()
        };
    }

    public static function createFromFile(string $path): self
    {
        try {
            $configs = json_decode(
               file_get_contents($path),
                flags: JSON_THROW_ON_ERROR
            )->sorting ?? [];
        } catch (JsonException) {
            $configs = [];
        }

        return new self(
            new Config([]),
            ...array_map(
                static fn (object $sorting) => Config::fromObject($sorting),
                $configs
            )
        );
    }
}
