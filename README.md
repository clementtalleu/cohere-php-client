[![Build Status](https://github.com/clementtalleu/cohere-php-client/actions/workflows/tests.yaml/badge.svg)](https://github.com/clementtalleu/cohere-php-client/actions)
![PHPStan](https://img.shields.io/badge/PHPStan-OK-brightgreen)
[![Packagist Version](https://img.shields.io/packagist/v/talleu/cohere-php-client.svg)](https://packagist.org/packages/talleu/cohere-php-client)
[![GitHub](https://img.shields.io/github/license/clementtalleu/cohere-php-client.svg)](https://github.com/averias/phpredis-json)


---------
## Cohere PHP Client

A PHP client to interact with the [Cohere® API](https://cohere.com/), designed to be framework-agnostic, simple to use,
and fully compatible with [PSR-18](https://www.php-fig.org/psr/psr-18/).

This package provides an easy and structured way to use Cohere's powerful language models — for **embeddings**, **chat**,
**classification**, **tokenization**, and more — in any PHP project.

---

## Features 🛠️

- ✅ Support for **Cohere API v1/v2** endpoints (chat, embed, classify, tokenize, etc.)
- ✅ Compatible with any **PSR-18 HTTP Client**
- ✅ File upload and multipart support
- ✅ Developer-friendly DTOs and response builders
- ✅ Easily extendable with your own endpoints

---

## Requirements ⚙️

- PHP **8.2** or higher
- Composer
- A PSR-18 compatible HTTP client (
  e.g. [Guzzle](https://github.com/guzzle/guzzle), [Symfony HttpClient](https://symfony.com/doc/current/http_client.html), [HTTPlug clients](https://packagist.org/providers/php-http/client-implementation))


## Installation 📝

Install the library via Composer:

```
composer require talleu/cohere-php-client
```

Then install your preferred HTTP client

Using Symfony HttpClient:

```
composer require symfony/http-client
```

Using Guzzle:

```
composer require guzzlehttp/guzzle
```

Or another client implementing PSR18

## Basic Usage 🎯

Minimal example

```php
use Talleu\CohereClient\Cohere;

$client = Cohere::client('your-api-key'); 

// Call the embed endpoint
$embeds = $client->embed()->create([
      'Cohere is amazing!',
      'Let’s try embedding some text.'
  ]);

var_dump($embeds);
```

Or to simple chats with LLM

```php
    $chat = $client->chat()->create([
        [
            'role' => 'user',
            'content' => 'how are you ?'
        ]
    ]);
```

## Authentication 🔐

You can pass the API key directly in the http client:

```php
Cohere::client('your-api-key');
```

Or use an environment variable (recommended):

```dotenv
#.env
COHERE_API_KEY=your-api-key
``` 

## Available Endpoints 📚

The following endpoints are supported:

| Endpoint        | Class        | Description                                             |
|-----------------|--------------|---------------------------------------------------------|
| `v2/embed`      | `Embed`      | Generate embeddings from input text                     |
| `v2/chat`       | `Chat`       | Perform conversational chat with a LLM                  |
| `v1/classify`   | `Classify`   | Text classification based on custom labels              |
| `v1/tokenize`   | `Tokenize`   | Token-level breakdown of input text                     |
| `v1/detokenize` | `Detokenize` | De-tokenify tokens to text                              |
| `v1/connectors` | `Connector`  | Cohere connectors                                       |
| `v1/embed-jobs` | `EmbedJob`   | Async embed jobs                                        |
| `v2/rerank`     | `Rerank`     | Retrieve Cohere available models                        |
| `v1/models`     | `Model`      | Produces an ordered array with text                     |
| `v1/datasets`   | `Dataset`    | Create a dataset by uploading a file, retrieve datasets |
| `v1/finetuning`   | `FineTuning` | Trains, deploy, list datasets                           |

You can access them via:

```php
$client->embed();
$client->chat();
$client->tokenize();
$client->detokenize();
$client->classify();
$client->rerank();
$client->dataset();
$client->fineTuning();
$client->model();
$client->embedJob();
$client->connector();
// etc.
```

Then you can use it simple :

```php
$connector = $client->connector()->create($name, $url, ['model' => 'command-a-03-2025']);
$connector = $client->connector()->get($id);
$connector = $client->connector()->list();
```

Each endpoint returns a strongly typed DTO with the result of the API call.

To send a request without using provided resources, you can use directly the CohereClient sendRequesst() method

```php
$chat = Cohere::client()->sendRequest('GET', '/v2/chat', $body);
```

## 📚 Documentation by endpoints

- [Embedding](docs/embed.md)
- [Chat Completion](docs/chat.md)
- [Rerank](docs/rerank.md)
- [Model](docs/model.md)
- [Connector](docs/connector.md)
- [Classify](docs/classify.md)
- [Fine Tuning](docs/fine-tuning.md)
- [Dataset](docs/dataset.md)
- [Embed jobs](docs/embed-job.md)
- [Tokenize](docs/tokenize.md)
- [Detokenize](docs/detokenize.md)
- [A tutorial for Fine-tune and Classify a dataset](docs/embed-job.md)

## Documentation 📚

- 🧠 Cohere official docs: https://docs.cohere.com
- 📘 API Reference: https://docs.cohere.com/reference
- 📦 This PHP client wraps the API endpoints in a friendly OO API with typed DTOs.

## Contributing 🤝

PRs are welcome! If you’d like to add support for more endpoints, improve tests or add features, feel free to open an
issue or submit a PR.