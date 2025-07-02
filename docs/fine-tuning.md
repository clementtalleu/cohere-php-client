```php
$fineTunedModel = $this->client->fineTuning()->patch(
        id: $id,
        name: "api-test-pem",
        settings: [
            'base_model' => ['base_type' => 'BASE_TYPE_CHAT'],
            'dataset_id' => 'dataset-chat-test-yrm0b5'
        ]);


$fineTunedModel = $this->client->fineTuning()->create(
    name: "fine-tuned-model",
    settings: [
        'base_model' => ['base_type' => 'BASE_TYPE_CLASSIFICATION'],
        'dataset_id' => 'dataset-classify-test-wjc8je'
    ]);

```
