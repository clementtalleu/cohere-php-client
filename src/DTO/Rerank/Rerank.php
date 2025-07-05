<?php


namespace Talleu\CohereClient\DTO\Rerank;

final class Rerank
{
    /**
     * @param array<int, array{index: string, relevance_score: float}> $results
     * @param array{
     *     api_version: array{version: string, is_experimental: bool},
     *     billed_units: array{search_units: int}} $meta
     */
    public function __construct(
        public array $results,
        public string $id,
        public array $meta,
    ) {
    }

    /**
     * @param array{
     *     results: array<int, array{index: string, relevance_score: float}>,
     *     id: string,
     *     meta: array{
     *         api_version: array{version: string, is_experimental: bool},
     *         billed_units: array{search_units: int}
     *     }
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            results: $data['results'],
            id: $data['id'],
            meta: $data['meta'],
        );
    }
}
