<?php


namespace Talleu\CohereClient\Resources\Dataset;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Dataset\CreateDataset;
use Talleu\CohereClient\DTO\Dataset\Dataset as DatasetObject;
use Talleu\CohereClient\DTO\Dataset\DatasetUsage;

final class Dataset
{
    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/create-dataset
     * @param array<string, mixed> $params
     */
    public function create(string $name, string $type, string $filePath, array $params = []): CreateDataset
    {
        $queryParams = array_merge($params, [
            'name' => $name,
            'type' => $type,
        ]);

        $path = '/v1/datasets?' . http_build_query($queryParams);

        $response = $this->client->sendMultipartRequest(
            method: 'POST',
            path: $path,
            formFields: [],
            fileFieldName: 'file',
            filePath: $filePath
        );

        return CreateDataset::create($response);
    }

    /**
     * @see https://docs.cohere.com/reference/list-datasets
     * @return DatasetObject[]
     */
    public function list(array $params = []): array
    {
        $path = '/v1/datasets';
        if (!empty($params)) {
            $path .= '?' . http_build_query($params);
        }

        $response = $this->client->sendRequest('GET', $path);

        return array_map([DatasetObject::class, 'create'], $response['datasets']);
    }

    /**
     * @see https://docs.cohere.com/reference/get-dataset-usage
     */
    public function getUsage(): DatasetUsage
    {
        $response = $this->client->sendRequest('GET', '/v1/datasets/usage');

        return DatasetUsage::create($response);
    }

    /**
     * @see https://docs.cohere.com/reference/get-dataset
     */
    public function get(string $id): DatasetObject
    {
        $response = $this->client->sendRequest('GET', "/v1/datasets/$id");

        return DatasetObject::create($response['dataset']);
    }

    /**
     * @see https://docs.cohere.com/reference/delete-dataset
     * @return array{key: string}
     */
    public function delete(string $id): array
    {
        return $this->client->sendRequest('DELETE', "/v1/datasets/$id");
    }
}
