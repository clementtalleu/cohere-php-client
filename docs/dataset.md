```php
   $dataset = $this->cohereClient->dataset()->create(
        "dataset-chat-test",
        "chat-finetune-input",
        __DIR__.'/chat.jsonl'
    );

    $dataset = $this->cohereClient->dataset()->create(
            "dataset-classify-test",
            "single-label-classification-finetune-input",
            __DIR__.'/single-label-classification-finetune-input.jsonl'
        );
```