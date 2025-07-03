<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\FineTuning;

final class StepMetrics
{
    public function __construct(
        public array  $stepMetrics,
        public string $nextPageToken
    ) {
    }

    public static function create(array $data): self
    {
        $stepMetrics = [];
        foreach ($data['step_metrics'] as $stepMetric) {
            $stepMetrics[] = StepMetric::create($stepMetric);
        }

        return new self(
            stepMetrics: $stepMetrics,
            nextPageToken: $data['next_page_token'],
        );
    }
}
