<?php


namespace Talleu\CohereClient\DTO\Dataset;

final class CreateDataset
{
    public function __construct(
        public string $id,
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
        );
    }
}
