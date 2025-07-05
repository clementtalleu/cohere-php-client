<?php


namespace Talleu\CohereClient\DTO\Embed;

final class Embed
{
    /**
     * @param array{float: array<int, array<int, float>} $embeddings
     * @param string[] $texts
     * @param array{api_version: array{version: string, is_experimental: bool}, billed_units: array{input_tokens: int}, warnings: string[]} $meta
     */
    public function __construct(
        public string $id,
        public array  $embeddings,
        public array  $texts,
        public array  $meta,
    ) {
    }

    /**
     * @param array{
     *     id: string,
     *     embeddings: array<int, array<int, float>>,
     *     texts: string[],
     *     meta: array{
     *         api_version: array{version: string, is_experimental: bool},
     *         billed_units: array{input_tokens: int},
     *         warnings: string[]
     *     }
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            embeddings: $data['embeddings'],
            texts: $data['texts'],
            meta: $data['meta']
        );
    }
}
