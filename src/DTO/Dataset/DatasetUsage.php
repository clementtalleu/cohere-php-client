<?php


namespace Talleu\CohereClient\DTO\Dataset;

final class DatasetUsage
{
    public function __construct(
        public string $organisationUsage,
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            organisationUsage: (string) $data['organization_usage'],
        );
    }
}
