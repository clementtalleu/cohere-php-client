```php
     $dataset = $cohereClient->dataset()->create(
            "dataset-classify-test",
            "single-label-classification-finetune-input",
            __DIR__.'/mon-fichier.jsonl'
        );
        
        $fineTunedModel = $cohereClient->fineTuning()->create(
            name: "fine-tuned-model",
            settings: [
                'base_model' => ['base_type' => 'BASE_TYPE_CLASSIFICATION'],
                'dataset_id' => $dataset->id
            ]);
        
        $classify = $cohereClient->classify()->create(
            fineTuneModelId: $fineTunedModel->id,
            inputs: ['Smooth experience and top-notch performance', 'Shipping took far too long'],
        );

```