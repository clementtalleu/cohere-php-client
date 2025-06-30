```php
$fineTunedModel = $this->client->fineTuning()->patch(
        id: $id,
        name: "api-test-pem",
        settings: [
            'base_model' => ['base_type' => 'BASE_TYPE_CHAT'],
            'dataset_id' => 'dataset-chat-test-yrm0b5'
        ]);
```