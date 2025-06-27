<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\Embed;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Embed\Embed as EmbedObject;

final class Embed
{
    public const DEFAULT_MODEL = 'embed-v4.0';

    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/embed
     */
    public function create(?array $params = []): EmbedObject
    {
        if (!array_key_exists('model', $params)) {
            $params['model'] = self::DEFAULT_MODEL;
        }

        $response = $this->client->sendRequest('POST', '/v2/embed', $params);

        return EmbedObject::create($response);
    }
}
