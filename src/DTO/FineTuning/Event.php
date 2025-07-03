<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\FineTuning;

final class Event
{
    public function __construct(
        public string             $userId,
        public string             $status,
        public \DateTimeImmutable $createdAt,
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            userId: $data['user_id'],
            status: $data['status'],
            createdAt: new \DateTimeImmutable($data['created_at']),
        );
    }
}
