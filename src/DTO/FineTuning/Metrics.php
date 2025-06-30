<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\FineTuning;

final class Metrics
{
    public function __construct(
        public float $accuracy,
        public float $crossEntropy,
        public float $generationAccuracy,
        public float $generationCrossEntropy,
        public int   $step
    )
    {
    }

    public static function create(array $data): self
    {
        return new self(
            accuracy: $data['accuracy'],
            crossEntropy: $data['cross_entropy'],
            generationAccuracy: $data['generation_accuracy'],
            generationCrossEntropy: $data['generation_cross_entropy'],
            step: $data['step']
        );
    }
}
