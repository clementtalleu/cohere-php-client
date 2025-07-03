<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Exception;

use Psr\Http\Client\ClientExceptionInterface;

class CohereApiException extends \RuntimeException implements ClientExceptionInterface
{
}