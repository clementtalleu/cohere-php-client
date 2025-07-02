### Models

These methods allow you to interact with Cohere's model registry using the `/models` endpoint.

#### List Models

```php
    $models = $cohereClient->model()->list();
    $model = $cohereClient->model()->get($modelId);
```


The `list()` method retrieves the full list of models available to your account.  
Each returned model includes metadata such as:

- Model name
- Supported endpoints
- Context length
- Tokenizer URL
- Whether it supports fine-tuning
- Feature availability

#### Get a Specific Model

The `get($modelId)` method fetches metadata for a single model by its ID.  
This includes the same fields as in the list, but in more detail for a specific model.

Useful to verify the capabilities or settings of a given model before using it in endpoints like `chat`, `embed`, or `rerank`.

📄 Refer to the official Cohere documentation for full details:  
[https://docs.cohere.com/reference/get-models](https://docs.cohere.com/reference/get-model)