<?php


namespace Talleu\CohereClient\DTO\FineTuning;

final class StepMetric
{
    public function __construct(
        public \DateTimeImmutable $createdAt,
        public int                $stepNumber,
        public Metrics            $metrics
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            createdAt: new \DateTimeImmutable($data['created_at']),
            stepNumber: $data['step_number'],
            metrics: Metrics::create($data['metrics'])
        );
    }
}
