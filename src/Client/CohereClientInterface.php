<?php


namespace Talleu\CohereClient\Client;

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

interface CohereClientInterface
{
    public function chat(): Chat;

    public function embed(): Embed;

    public function rerank(): Rerank;

    public function classify(): Classify;

    public function fineTuning(): FineTuning;

    public function dataset(): Dataset;

    public function tokenize(): Tokenize;

    public function detokenize(): Detokenize;

    public function embedJob(): EmbedJob;

    public function connector(): Connector;

    public function model(): Model;

    public function sendRequest(string $method, string $path, array $body): array;

    public function sendMultipartRequest(
        string $method,
        string $path,
        array $formFields,
        string $fileFieldName,
        string $filePath,
        ?string $fileMimeType = null
    ): array;
}
