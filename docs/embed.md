### Create Embeddings

This method allows you to generate embeddings for one or more pieces of text using Cohere's `/embed` endpoint.

```php
  $embeds = $cohereClient->embed()->create(texts: [
            'Cohere is amazing!',
            'Let’s try embedding some text.'
        ]);
        
    var_dump($embeds->embeddings);
```

#### Parameters

- `texts` (required):  
  An array of strings to embed. Each string in the array represents a separate input to be converted into an embedding.

- `params` (optional):  
  An associative array containing any additional parameters accepted by Cohere's `embed` endpoint.  
  These include, for example:
    - `model`: (string) The name of the model to use.
    - `input_type`: (string) A hint about the type of content (e.g., `'search_document'` or `'classification'`).
    - ...

You can refer to the official Cohere documentation for the full list of available parameters and usage examples:

👉 [Cohere Embed API Documentation](https://docs.cohere.com/reference/embed)