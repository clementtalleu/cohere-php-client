<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\Chat;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Chat\Chat as ChatObject;

final class Chat
{
    public const DEFAULT_MODEL = 'command-a-03-2025';

    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/chat
     *
     * @param array<int, array{role: string, content: string}> $messages
     * @param array<string, mixed> $params
     */
    public function create(array $messages, ?array $params = []): ChatObject
    {
        if (!array_key_exists('model', $params)) {
            $params['model'] = self::DEFAULT_MODEL;
        }

        $params['stream'] = false;
        $params['messages'] = $messages;

        $response = $this->client->sendRequest('POST', '/v2/chat', $params);

        return ChatObject::create($response);
    }
}
