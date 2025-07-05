<?php

namespace Talleu\CohereClient\DTO\Chat;

final class Chat
{
    /**
     * @param array{role: string, content: array<int, array{type: string, text: string}>} $message
     * @param array{billed_units: array{input_tokens: int, output_tokens: int}, tokens: array{input_tokens: int, output_tokens: int}} $usage
     */
    public function __construct(
        public string $id,
        public string $finishReason,
        public array $message,
        public array $usage,
    ) {
    }

    /**
     * @param array{
     *     id: string,
     *     finish_reason: string,
     *     message: array{
     *         role: string,
     *         content: array<int, array{type: string, text: string}>
     *     },
     *     usage: array{
     *         billed_units: array{input_tokens: int, output_tokens: int},
     *         tokens: array{input_tokens: int, output_tokens: int}
     *     }
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            finishReason: $data['finish_reason'],
            message: $data['message'],
            usage: $data['usage'],
        );
    }
}
