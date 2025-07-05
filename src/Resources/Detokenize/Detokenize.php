<?php


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
    public function create(array $tokens, array $params = []): DetokenizeObject
    {
        $body = array_merge(
            ['model' => self::DEFAULT_MODEL],
            $params,
            ['tokens' => $tokens]
        );

        $response = $this->client->sendRequest('POST', '/v1/detokenize', $body);

        return DetokenizeObject::create($response);
    }
}
