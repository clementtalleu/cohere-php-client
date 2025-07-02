### Rerank

This method allows you to reorder a list of documents based on their relevance to a given query using Cohere’s `/rerank` endpoint.

```php
  $rerank = $cohereClient->rerank()->create(
          query: 'What is the capital of the United States?',
          documents: ["Carson City is the capital city of the American state of Nevada.",
              "Washington, D.C. (also known as simply Washington or D.C., and officially as the District of Columbia) is the capital of the United States. It is a federal district.",
              "Capital punishment has existed in the United States since beforethe United States was a country. As of 2017, capital punishment is legal in 30 of the 50 states."]
      );

  var_dump($rerank->results);
```

#### Parameters

- `query` (required):  
  A string representing the user’s question or search input. It will be used to evaluate the relevance of each document.

- `documents` (required):  
  An array of strings, where each string represents a document (text) to be ranked based on relevance to the query.

- `params` (optional):  
  An associative array of additional parameters accepted by Cohere’s rerank endpoint, such as:
  - `model`: (string) The rerank model to use (e.g., `'rerank-english-v2.0'`)
  - `top_n`: (int) Number of top results to return (defaults to all)
  - `max_tokens_per_doc`: (int) Long documents will be automatically truncated to the specified number of tokens.
  - ...

For full details on parameters and model behavior, refer to the official documentation:

👉 [Cohere Rerank API Documentation](https://docs.cohere.com/reference/rerank)

