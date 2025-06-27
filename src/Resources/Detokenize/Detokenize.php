<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\Detokenize;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Detokenize\Detokenize as DetokenizeObject;

final class Detokenize
{
    public const DEFAULT_MODEL = 'command-a-03-2025';

    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/detokenize
     */
    public function create(array $tokens, ?array $params = []): DetokenizeObject
    {
        if (!array_key_exists('model', $params)) {
            $params['model'] = self::DEFAULT_MODEL;
        }

        $params['tokens'] = $tokens;
        $response = $this->client->sendRequest('POST', '/v1/detokenize', $params);

        return DetokenizeObject::create($response);
    }
}
