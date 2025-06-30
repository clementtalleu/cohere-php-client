```php
   $dataset = $this->cohereClient->dataset()->create(
        "dataset-chat-test",
        "chat-finetune-input",
        __DIR__.'/chat.jsonl'
    );
```