<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Resources\Classify;

use Talleu\CohereClient\Client\CohereClient;
use Talleu\CohereClient\DTO\Classify\Classify as ClassifyObject;

final class Classify
{
    public function __construct(private CohereClient $client)
    {
    }

    /**
     * @see https://docs.cohere.com/reference/classify
     *
     * @param string[] $inputs
     * @param array<int, array<string, string> $examples
     */
    public function create(string $fineTuneModelId, array $inputs, ?array $examples = [], ?array $params = []): ClassifyObject
    {
        $params['model'] = $fineTuneModelId;
        $params['inputs'] = $inputs;
        $params['examples'] = $examples;
        $response = $this->client->sendRequest('POST', '/v1/classify', $params);

        return ClassifyObject::create($response);
    }
}
