### Classify

This method allows you to use a fine-tuned classification model to categorize input texts.  
It leverages a model you’ve previously fine-tuned using Cohere’s platform for single- or multi-label classification.

```php
    $models = $cohereClient->classify()->create(
            fineTuneModelId: $fineTunelModelId,
            inputs: ['Smooth experience and top-notch performance', 'Shipping took far too long'],
        );
```

#### Parameters

- `fineTuneModelId` (required):  
  The identifier of the fine-tuned model to use for classification. This must be the ID of a model trained via the fine-tuning API.

- `inputs` (required):  
  An array of strings to classify. Each string represents a piece of text that the model will evaluate and assign one or more labels to.

- `params` (optional):  
  An associative array to pass additional optional parameters supported by the Cohere API. This could include flags like confidence thresholds or metadata settings.

📄 For full details, see the official Cohere documentation:  
[https://docs.cohere.com/reference/classify](https://docs.cohere.com/reference/classify)
