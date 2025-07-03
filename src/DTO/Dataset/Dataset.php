<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\Dataset;

final class Dataset
{
    /**
     * @param string[] $requiredFields
     * @param string[] $preserveFields
     * @param array<int, array{id: string, name: string}> $datasetParts
     * @param string[] $validationWarnings
     */
    public function __construct(
        public string             $id,
        public string             $name,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
        public string             $datasetType,
        public string             $validationStatus,
        public array              $requiredFields,
        public array              $preserveFields,
        public array              $datasetParts,
        public array              $validationWarnings,
        public array              $metrics,
        public ?string            $validationError = null,
        public ?string            $schema = null,
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            createdAt: new \DateTimeImmutable($data['created_at']),
            updatedAt: new \DateTimeImmutable($data['updated_at']),
            datasetType: $data['dataset_type'],
            validationStatus: $data['validation_status'],
            requiredFields: $data['required_fields'] ?? [],
            preserveFields: $data['preserve_fields'] ?? [],
            datasetParts: $data['dataset_parts'],
            validationWarnings: $data['validation_warnings'] ?? [],
            metrics: $data['metrics'] ?? [],
            validationError: $data['validation_error'] ?? null,
            schema: $data['schema'] ?? null,
        );
    }
}
