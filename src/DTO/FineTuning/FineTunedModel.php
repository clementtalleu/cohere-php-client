<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\FineTuning;

final class FineTunedModel
{
    /**
     * @param array{
     * base_model: array{base_type: string, name: string, strategy: string},
     * dataset_id: string,
     * hyperparameters: null|array<string, mixed>,
     * wandb: null|array{project: string, api_key: string, entity: null|string}
     * } $settings
     */
    public function __construct(
        public string              $id,
        public string              $name,
        public array               $settings,
        public string              $creatorId,
        public string              $status,
        public ?string             $organisationId = null,
        public ?\DateTimeImmutable $createdAt = null,
        public ?\DateTimeImmutable $updatedAt = null,
        public ?\DateTimeImmutable $completedAt = null,
        public ?\DateTimeImmutable $lastUsed = null,
    ) {
    }

    /**
     * @param array{
     *     name: string,
     *     settings: array{
     *         base_model: array{base_type: string, name: string, strategy: string},
     *         dataset_id: string,
     *         hyperparameters: null|array<string, mixed>,
     *         wandb: null|array{project: string, api_key: string, entity: null|string}
     *     },
     *     id: string,
     *     creator_id: string,
     *     organisation_id: string,
     *     status: string,
     *     created_at: string,
     *     updated_at: string,
     *     completed_at: string,
     *     last_used: string
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            settings: $data['settings'],
            creatorId: $data['creator_id'],
            status: $data['status'],
            organisationId: $data['organisation_id'] ?? null,
            createdAt: isset($data['created_at']) ? new \DateTimeImmutable($data['created_at']) : null,
            updatedAt: isset($data['updated_at']) ? new \DateTimeImmutable($data['updated_at']) : null,
            completedAt: isset($data['completed_at']) ? new \DateTimeImmutable($data['completed_at']) : null,
            lastUsed: isset($data['last_used']) ? new \DateTimeImmutable($data['last_used']) : null,
        );
    }
}
