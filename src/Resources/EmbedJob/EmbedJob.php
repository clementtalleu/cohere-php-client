<?php


namespace Talleu\CohereClient\Resources\EmbedJob;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\EmbedJob\CreateEmbedJob;
use Talleu\CohereClient\DTO\EmbedJob\EmbedJob as EmbedJobObject;

final class EmbedJob
{
    public const DEFAULT_MODEL = 'embed-v4.0';

    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/create-embed-job
     * @param array<string, mixed>|null $params
     */
    public function create(string $datasetId, ?string $inputType = 'search_document', ?array $params = []): CreateEmbedJob
    {
        if (!array_key_exists('model', $params)) {
            $params['model'] = self::DEFAULT_MODEL;
        }

        $params['dataset_id'] = $datasetId;
        $params['input_type'] = $inputType;

        $response = $this->client->sendRequest('POST', '/v1/embed-jobs', $params);

        return CreateEmbedJob::create($response);
    }

    /**
     * @see https://docs.cohere.com/reference/list-embed-jobs
     *
     * @return EmbedJobObject[]
     */
    public function list(): array
    {
        $response = $this->client->sendRequest('GET', '/v1/embed-jobs');

        if (null === $response['embed_jobs']) {
            return [];
        }

        $embedJobs = [];
        foreach ($response['embed_jobs'] as $embedJob) {
            $embedJobs[] = EmbedJobObject::create($embedJob);
        }

        return $embedJobs;
    }

    /**
     * @see https://docs.cohere.com/reference/get-embed-job
     */
    public function get(string $embedJobId): EmbedJobObject
    {
        $response = $this->client->sendRequest('GET', "/v1/embed-jobs/$embedJobId");

        return EmbedJobObject::create($response);
    }

    /**
     * @see https://docs.cohere.com/reference/cancel-embed-job
     */
    public function cancel(string $embedJobId): void
    {
        $this->client->sendRequest('POST', "/v1/embed-jobs/$embedJobId/cancel");
    }
}
