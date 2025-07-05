<?php


namespace Talleu\CohereClient\Resources\Connector;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Connector\Connector as ConnectorObject;

final class Connector
{
    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/create-connector
     *
     * @param array<string, mixed> $params
     */
    public function create(string $name, string $url, ?array $params = []): ConnectorObject
    {
        $body = array_merge($params, [
            'name' => $name,
            'url' => $url,
        ]);

        $response = $this->client->sendRequest('POST', '/v1/connectors', $body);

        return ConnectorObject::create($response['connector']);
    }

    /**
     * @see https://docs.cohere.com/reference/get-connector
     */
    public function get(string $id): ConnectorObject
    {
        $response = $this->client->sendRequest('GET', '/v1/connectors/'.$id);

        return ConnectorObject::create($response['connector']);
    }

    /**
     * @see https://docs.cohere.com/reference/get-connector
     * @param array<string, string> $params
     * @return ConnectorObject[]
     */
    public function list(?array $params = []): array
    {
        $query = http_build_query($params);
        $response = $this->client->sendRequest('GET', "/v1/connectors?$query");

        $connectors = [];
        foreach ($response['connectors'] as $connector) {
            $connectors[] = ConnectorObject::create($connector);
        }

        return $connectors;
    }

    /**
     * @see https://docs.cohere.com/reference/update-connector
     */
    public function update(string $id, ?array $params = []): ConnectorObject
    {
        $response = $this->client->sendRequest('PATCH', "/v1/connectors/$id", $params);

        return ConnectorObject::create($response['connector']);
    }

    /**
     * @see https://docs.cohere.com/reference/delete-connector
     * @return array{key: string}
     */
    public function delete(string $id): array
    {
        return $this->client->sendRequest('DELETE', "/v1/connectors/$id");
    }
}
