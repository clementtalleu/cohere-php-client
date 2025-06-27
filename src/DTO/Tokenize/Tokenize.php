<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\Tokenize;

final class Tokenize
{
    /**
     * @param string[] $tokenStrings
     * @param int[] $tokens
     * @param array{api_version: array{version: string}} $meta
     */
    public function __construct(
        public array $tokenStrings,
        public array $tokens,
        public array $meta,
    ) {
    }

    /**
     * @param array{
     *     token_strings: string[],
     *     tokens: int[],
     *     meta: array{api_version: array{version: string}}
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            tokenStrings: $data['token_strings'],
            tokens: $data['tokens'],
            meta: $data['meta'],
        );
    }
}
