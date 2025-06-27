<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\Model;

final class Model
{
    /**
     * @param string[] $endpoints
     * @param string[] $defaultEndpoints
     * @param string[] $features
     */
    public function __construct(
        public string $name,
        public array  $endpoints,
        public bool   $fineTuned,
        public float  $contextLength,
        public string $tokenizerUrl,
        public float  $supportVision,
        public array  $defaultEndpoints,
        public array  $features
    ) {
    }

    /**
     * @param array{
     *     name: string,
     *     endpoints: string[],
     *     fine_tuned: bool,
     *     context_length: float,
     *     tokenizer_url: string,
     *     support_vision: float,
     *     default_endpoints: string[],
     *     features: string[]
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            name: $data['name'],
            endpoints: $data['endpoints'],
            fineTuned: $data['fine_tuned'],
            contextLength: $data['context_length'],
            tokenizerUrl: $data['tokenizer_url'],
            supportVision: $data['support_vision'],
            defaultEndpoints: $data['default_endpoints'],
            features: $data['features']
        );
    }
}
