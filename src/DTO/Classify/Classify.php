<?php


namespace Talleu\CohereClient\DTO\Classify;

final class Classify
{
    /**
     *
     * @param array<int, array{
     *     id: string,
     *     input: string,
     *     predictions: string[],
     *     confidences: float[],
     *     labels: array<string, array{confidence: float}>,
     *     classification_type: string,
     *     prediction: string,
     *     confidence: float}> $classifications
     * @param array{api_version: array{version: string, is_experimental: bool}, billed_units: array{input_tokens: int}, warnings: string[]} $meta
     */
    public function __construct(
        public string $id,
        public array  $classifications,
        public array  $meta,
    ) {
    }

    /**
     * @param array{
     *     id: string,
     *     classifications: array<int, array{
     *         id: string,
     *         input: string,
     *         predictions: string[],
     *         confidences: float[],
     *         labels: array<string, array{confidence: float}>,
     *         classification_type: string,
     *         prediction: string,
     *         confidence: float
     *     }>,
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
            classifications: $data['classifications'],
            meta: $data['meta'],
        );
    }
}
