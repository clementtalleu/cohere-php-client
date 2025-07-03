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
     * @param null|string[] $texts
     */
    public function create(array $texts = [], array $params = []): EmbedObject
    {
        $body = array_merge(
            ['model' => self::DEFAULT_MODEL],
            $params,
            ['texts' => $texts]
        );

        $response = $this->client->sendRequest('POST', '/v2/embed', $body);

        return EmbedObject::create($response);
    }
}
