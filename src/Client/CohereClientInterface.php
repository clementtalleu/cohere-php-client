<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Client;

use Talleu\CohereClient\Resources\Chat\Chat;

interface CohereClientInterface
{
    public function chat(): Chat;

    public function sendRequest(string $method, string $path, array $body): array;
}
