<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\Dataset;

final class DatasetUsage
{
    public function __construct(
        public int $organisationUsage,
    )
    {
    }

    public static function create(array $data): self
    {
        return new self(
            organisationUsage: $data['organization_usage'],
        );
    }
}
