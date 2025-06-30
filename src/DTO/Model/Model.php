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
        public string  $name,
        public array   $endpoints,
        public bool    $fineTuned,
        public float   $contextLength,
        public ?string $tokenizerUrl = null,
        public bool    $supportVision,
        public array   $defaultEndpoints,
        public ?array  $features = []
    )
    {
    }

    /**
     * @param array{
     *     name: string,
     *     endpoints: string[],
     *     fine_tuned: bool,
     *     context_length: float,
     *     tokenizer_url: string,
     *     support_vision: bool,
     *     default_endpoints: string[],
     *     features: null|string[]
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            name: $data['name'],
            endpoints: $data['endpoints'],
            fineTuned: $data['finetuned'],
            contextLength: $data['context_length'],
            tokenizerUrl: $data['tokenizer_url'],
            supportVision: $data['supports_vision'],
            defaultEndpoints: $data['default_endpoints'],
            features: $data['features']
        );
    }
}
