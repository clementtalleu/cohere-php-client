<?php


namespace Talleu\CohereClient\Resources\Tokenize;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Tokenize\Tokenize as TokenizeObject;

final class Tokenize
{
    public const DEFAULT_MODEL = 'command-a-03-2025';

    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/tokenize
     */
    public function create(string $text, array $params = []): TokenizeObject
    {
        $body = array_merge(
            ['model' => self::DEFAULT_MODEL],
            $params,
            ['text' => $text]
        );

        $response = $this->client->sendRequest('POST', '/v1/tokenize', $body);

        return TokenizeObject::create($response);
    }
}
