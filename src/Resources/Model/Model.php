<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\Model;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Model\Model as ModelObject;

final class Model
{
    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/list-models
     */
    public function get(string $model): ModelObject
    {
        $response = $this->client->sendRequest('GET', '/v1/models/'.$model);

        return ModelObject::create($response);
    }

    /**
     * @see https://docs.cohere.com/reference/get-connector
     * @return ModelObject[]
     */
    public function list(?array $params = []): array
    {
        $query = http_build_query($params);
        $response = $this->client->sendRequest('GET', "/v1/models?$query");

        $models = [];
        foreach ($response['models'] as $model) {
            $models[] = ModelObject::create($model);
        }

        return $models;
    }
}
