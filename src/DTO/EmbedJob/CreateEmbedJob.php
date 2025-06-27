<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\EmbedJob;

final class CreateEmbedJob
{
    /**
     * @param string $jobId
     * @param array{
     *     api_version: array{version: string, is_deprecated: bool, is_experimental: bool},
     *     billed_units: array{images: float, input_tokens: float, ouptut_tokens: float, search_units: float, classifications: float},
     *     tokens: array {input_tokens: float, ouptut_tokens: float},
     *     warnings: string[]} $meta
     */
    public function __construct(
        public string $jobId,
        public array  $meta,
    ) {
    }

    /**
     * @param array{
     *     job_id: string,
     *     meta: array{
     *         api_version: array{version: string, is_deprecated: bool, is_experimental: bool},
     *         billed_units: array{
     *             images: float,
     *             input_tokens: float,
     *             ouptut_tokens: float,
     *             search_units: float,
     *             classifications: float
     *         },
     *         tokens: array{input_tokens: float, ouptut_tokens: float},
     *         warnings: string[]
     *     }
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            jobId: $data['job_id'],
            meta: $data['meta']
        );
    }
}
