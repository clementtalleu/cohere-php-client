<?php

namespace Talleu\CohereClient\Client;

use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Talleu\CohereClient\Exception\CohereApiException;
use Talleu\CohereClient\Resources\Chat\Chat;
use Talleu\CohereClient\Resources\Classify\Classify;
use Talleu\CohereClient\Resources\Connector\Connector;
use Talleu\CohereClient\Resources\Dataset\Dataset;
use Talleu\CohereClient\Resources\Detokenize\Detokenize;
use Talleu\CohereClient\Resources\Embed\Embed;
use Talleu\CohereClient\Resources\EmbedJob\EmbedJob;
use Talleu\CohereClient\Resources\FineTuning\FineTuning;
use Talleu\CohereClient\Resources\Model\Model;
use Talleu\CohereClient\Resources\Rerank\Rerank;
use Talleu\CohereClient\Resources\Tokenize\Tokenize;
use Http\Message\MultipartStream\MultipartStreamBuilder;

final class CohereClient implements CohereClientInterface
{
    private const COHERE_API_BASE_URL = 'https://api.cohere.com';

    public function __construct(
        private ?string $apiKey = null,
        private ?string $baseUri = null,
        private ?string $clientName = null,
        private ?ClientInterface $httpClient = null,
        private ?RequestFactoryInterface $requestFactory = null,
        private ?StreamFactoryInterface $streamFactory = null,
    ) {
        $this->apiKey = $apiKey ?? $_ENV['COHERE_API_KEY'];
        $this->baseUri = $baseUri ?? self::COHERE_API_BASE_URL;
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    public function chat(): Chat
    {
        return new Chat($this);
    }

    public function embed(): Embed
    {
        return new Embed($this);
    }

    public function rerank(): Rerank
    {
        return new Rerank($this);
    }

    public function classify(): Classify
    {
        return new Classify($this);
    }

    public function fineTuning(): FineTuning
    {
        return new FineTuning($this);
    }

    public function dataset(): Dataset
    {
        return new Dataset($this);
    }

    public function tokenize(): Tokenize
    {
        return new Tokenize($this);
    }

    public function detokenize(): Detokenize
    {
        return new Detokenize($this);
    }

    public function embedJob(): EmbedJob
    {
        return new EmbedJob($this);
    }

    public function connector(): Connector
    {
        return new Connector($this);
    }

    public function model(): Model
    {
        return new Model($this);
    }

    public function sendRequest(string $method, string $path, ?array $body = null): array
    {
        $request = $this->requestFactory->createRequest($method, $this->baseUri . $path)
            ->withHeader('Authorization', 'Bearer ' . $this->apiKey)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json');

        if ($this->clientName) {
            $request = $request->withHeader('X-Client-Name', $this->clientName);
        }

        if ($body) {
            $payload = json_encode($body, JSON_UNESCAPED_UNICODE);
            $stream = $this->streamFactory->createStream($payload);
            $request = $request->withBody($stream);
        }

        $response = $this->httpClient->sendRequest($request);

        return $this->handleResponse($response);
    }

    public function sendMultipartRequest(
        string $method,
        string $path,
        array $formFields,
        string $fileFieldName,
        string $filePath,
        ?string $fileMimeType = null
    ): array {
        $builder = new MultipartStreamBuilder($this->streamFactory);

        foreach ($formFields as $name => $value) {
            $builder->addResource($name, $value);
        }

        $fileResource = fopen($filePath, 'r');
        if ($fileResource === false) {
            throw new \RuntimeException("Unable to open file : " . $filePath);
        }

        $builder->addResource($fileFieldName, $fileResource, [
            'filename' => basename($filePath),
            // Automatic detect of mime type if none provided
            'headers' => ['Content-Type' => $fileMimeType ?? mime_content_type($filePath) ?: 'application/octet-stream']
        ]);

        $multipartStream = $builder->build();
        $boundary = $builder->getBoundary();

        $request = $this->requestFactory->createRequest($method, $this->baseUri . $path)
            ->withHeader('Authorization', "Bearer {$this->apiKey}")
            ->withHeader('Content-Type', 'multipart/form-data; boundary=' . $boundary)
            ->withBody($multipartStream);


        $response = $this->httpClient->sendRequest($request);

        return $this->handleResponse($response);
    }

    private function handleResponse(ResponseInterface $response): array
    {
        $responseContents = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode >= 300) {
            $errorData = json_decode($responseContents, true);
            $errorMessage = $errorData['message'] ?? $responseContents;

            throw new CohereApiException(sprintf(
                'Cohere API returned HTTP %d: %s',
                $statusCode,
                $errorMessage
            ), $statusCode);
        }

        return json_decode($responseContents, true);
    }
}
