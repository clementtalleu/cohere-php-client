<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\Rerank;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Rerank\Rerank as RerankObject;

final class Rerank
{
    public const DEFAULT_MODEL = 'rerank-v3.5';

    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/rerank
     *
     * @param string[] $documents
     * @param array<string, mixed> $params
     */
    public function create(string $query, array $documents, ?array $params = []): RerankObject
    {
        if (!array_key_exists('model', $params)) {
            $params['model'] = self::DEFAULT_MODEL;
        }

        $params['query'] = $query;
        $params['documents'] = $documents;

        $response = $this->client->sendRequest('POST', '/v2/rerank', $params);

        return RerankObject::create($response);
    }
}
