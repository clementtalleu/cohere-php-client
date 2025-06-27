<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\EmbedJob;

final class EmbedJob
{
    /**
     * @param array{
     *          api_version: array{version: string, is_deprecated: bool, is_experimental: bool},
     *          billed_units: array{
     *              images: float,
     *              input_tokens: float,
     *              output_tokens: float,
     *              search_units: float,
     *              classifications: float
     *          },
     *          tokens: array{input_tokens: float, output_tokens: float},
     *          warnings: string[]
     *      } $meta
     */
    public function __construct(
        public string             $jobId,
        public string             $status,
        public \DateTimeImmutable $createdAt,
        public string             $inputDatasetId,
        public string             $model,
        public string             $truncate,
        public string             $outputDatasetId,
        public array              $meta,
    ) {
    }

    /**
     * @param array{
     *     job_id: string,
     *     status: string,
     *     created_at: string,
     *     input_dataset_id: string,
     *     model: string,
     *     truncate: string,
     *     output_dataset_id: string,
     *     meta: array{
     *         api_version: array{version: string, is_deprecated: bool, is_experimental: bool},
     *         billed_units: array{
     *             images: float,
     *             input_tokens: float,
     *             output_tokens: float,
     *             search_units: float,
     *             classifications: float
     *         },
     *         tokens: array{input_tokens: float, output_tokens: float},
     *         warnings: string[]
     *     }
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            jobId: $data['job_id'],
            status: $data['status'],
            createdAt: new \DateTimeImmutable($data['created_at']),
            inputDatasetId: $data['input_dataset_id'],
            model: $data['model'],
            truncate: $data['truncate'],
            outputDatasetId: $data['output_dataset_id'],
            meta: $data['meta'],
        );
    }
}
