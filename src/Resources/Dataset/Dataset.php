<?php

declare(strict_types=1);

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
    public function create(string $name, string $type, string $filePath, ?array $params = []): CreateDataset
    {
        $query = [
            'name' => $name,
            'type' => $type,
        ];

        if (!empty($params)) {
            $query = array_merge($query, $params);
        }

        $queryString = http_build_query($query);
        $path = '/v1/datasets?' . $queryString;

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
    public function list(?array $params = []): array
    {
        $query = http_build_query($params);
        $response = $this->client->sendRequest('GET', "/v1/datasets?$query");

        $datasets = [];
        foreach ($response['datasets'] as $dataset) {
            $datasets[] = DatasetObject::create($dataset);
        }

        return $datasets;
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
        $response = $this->client->sendRequest('DELETE', "/v1/datasets/$id");

        return $response;
    }
}
