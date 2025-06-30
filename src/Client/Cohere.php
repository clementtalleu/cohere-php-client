<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Client;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class Cohere
{
    public static function client(
        ?string $apiKey = null,
        ?string $baseUri = null,
        ?string $clientName = null,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ): CohereClient {
        
        
        return new CohereClient(
            $apiKey,
            $baseUri,
            $clientName,
            $httpClient,
            $requestFactory,
            $streamFactory
        );
    }
}
