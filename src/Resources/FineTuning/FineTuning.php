<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\FineTuning;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Classify\Classify as ClassifyObject;
use Talleu\CohereClient\DTO\FineTuning\Chronology;
use Talleu\CohereClient\DTO\FineTuning\Event;
use Talleu\CohereClient\DTO\FineTuning\FineTunedModel;
use Talleu\CohereClient\DTO\FineTuning\StepMetric;
use Talleu\CohereClient\DTO\FineTuning\StepMetrics;

final class FineTuning
{
    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/createfinetunedmodel
     *
     * @param array{
     *     base_model: array{base_type: string, name: string, strategy: string},
     *     dataset_id: string,
     *     hyperparameters: null|array<string, mixed>,
     *     wandb: null|array{project: string, api_key: string, entity: null|string}
     * } $settings
     */
    public function create(string $name, array $settings, array $params = []): FineTunedModel
    {
        $body = array_merge(
            $params,
            [
                'name' => $name,
                'settings' => $settings,
            ]
        );

        $response = $this->client->sendRequest('POST', '/v1/finetuning/finetuned-models', $body);

        return FineTunedModel::create($response['finetuned_model']);
    }

    /**
     * @see https://docs.cohere.com/reference/updatefinetunedmodel
     *
     * @param array{
     *     base_model: array{base_type: string, name: string, strategy: string},
     *     dataset_id: string,
     *     hyperparameters: null|array<string, mixed>,
     *     wandb: null|array{project: string, api_key: string, entity: null|string}
     * } $settings
     */
    public function patch(string $id, string $name, array $settings, array $params = []): FineTunedModel
    {
        $body = array_merge(
            $params,
            [
                'name' => $name,
                'settings' => $settings,
            ]
        );

        $response = $this->client->sendRequest('PATCH', "/v1/finetuning/finetuned-models/$id", $body);

        return FineTunedModel::create($response['finetuned_model']);
    }

    /**
     * @see https://docs.cohere.com/reference/getfinetunedmodel
     */
    public function get(string $id): FineTunedModel
    {
        $response = $this->client->sendRequest('GET', "/v1/finetuning/finetuned-models/$id");

        return FineTunedModel::create($response['finetuned_model']);
    }

    /**
     * @see https://docs.cohere.com/reference/deletefinetunedmodel
     * @return array{key: string}
     */
    public function delete(string $id): array
    {
        return $this->client->sendRequest('DELETE', "/v1/finetuning/finetuned-models/$id");
    }

    /**
     * @see https://docs.cohere.com/reference/listevents
     */
    public function events(string $id): Chronology
    {
        $response = $this->client->sendRequest('GET', "/v1/finetuning/finetuned-models/$id/events");

        return Chronology::create($response);
    }

    /**
     * @see https://docs.cohere.com/reference/listtrainingstepmetrics
     */
    public function metrics(string $id, ?array $params = []): StepMetrics
    {
        $query = http_build_query($params);
        $response = $this->client->sendRequest('GET', "/v1/finetuning/finetuned-models/$id/training-step-metrics?$query");

        return StepMetrics::create($response);
    }
}
