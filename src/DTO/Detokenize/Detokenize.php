<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\Detokenize;

final class Detokenize
{
    /**
     * @param array{api_version: array{version: string}} $meta
     */
    public function __construct(
        public string $text,
        public array $meta,
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            text: $data['text'],
            meta: $data['meta'],
        );
    }
}
