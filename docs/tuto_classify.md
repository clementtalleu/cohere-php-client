## 🚀 Tutorial: Fine-tune and Classify with Cohere using PHP

This guide shows you how to:

1. Upload a dataset for fine-tuning
2. Create a fine-tuned classification model
3. Use the model to classify new input texts

---

### Step 1 – Upload the Dataset (`.jsonl`)

Before fine-tuning, you must upload a training dataset in `.jsonl` format.  
Each line must include a `text` field and a `label` (for single-label classification) or `labels` (for multi-label classification).

**Important**:  
Make sure the dataset status is **`ready`** before starting fine-tuning.  
Datasets in `processing` cannot be used to train a model.

📘 Refer to [Cohere's dataset format guide](https://docs.cohere.com/docs/datasets#dataset-creation) for more details.

---

### Step 2 – Launch Fine-tuning

Once your dataset is uploaded and marked as `ready`, you can start training.  
You will need to specify the training settings, such as:

- `name`: Your custom model's name
- `base_model`: Define the task type (here `BASE_TYPE_CLASSIFICATION`)
- `dataset_id`: The ID of your uploaded dataset

Fine-tuning may take several minutes depending on the dataset size.

---

### Step 3 – Use the Fine-tuned Model

Once the fine-tuned model is ready, you can use it for inference via the `classify()` endpoint.  
Simply pass the model ID and the list of texts to classify.


## 💻 Example PHP Code

```php
// 1. Upload the dataset
$dataset = $cohereClient->dataset()->create(
    name: "my-dataset",
    type: "single-label-classification-finetune-input",
    filePath: __DIR__.'/data.jsonl'
);

// ⚠️ Wait until dataset status is 'ready' before continuing

// 2. Fine-tune the model
$fineTunedModel = $cohereClient->fineTuning()->create(
    name: "my-classifier-model",
    settings: [
        'base_model' => [
            'base_type' => 'BASE_TYPE_CLASSIFICATION',
        ],
        'dataset_id' => $dataset->id
    ]
);

// 3. Classify new input texts
$response = $cohereClient->classify()->create(
    fineTuneModelId: $fineTunedModel->id,
    inputs: [
        'Smooth experience and top-notch performance',
        'Shipping took far too long'
    ]
);
