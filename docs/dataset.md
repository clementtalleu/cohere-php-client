# 📦 Dataset Management

This section explains how to manage datasets using the Cohere PHP client.

---

## 📝 Create a Dataset

Use the `create` method to upload a dataset file (`.jsonl` or `.csv`) for training or fine-tuning purposes.

- **Supported types**:
    - `chat-finetune-input`
    - `generative-finetune-input`
    - `single-label-classification-finetune-input`
    - `multi-label-classification-finetune-input`
    - `embed-input`

📌 Make sure your file follows the correct format required by Cohere. Refer to the [Cohere dataset documentation](https://docs.cohere.com/reference/create-dataset) for formatting examples.


```php
 $dataset = $cohereClient->dataset()->create(
        name: "dataset-chat-name",
        type: "chat-finetune-input",
        filePath: __DIR__.'/chat.jsonl'
    );
```

---

## 📂 Retrieve a Dataset

You can retrieve a dataset’s details by calling the `get` method with its ID.

This includes metadata such as:
- dataset status (`processing`, `ready`, etc.)
- creation date
- dataset type
- validation info

⚠️ A dataset must be in `ready` status before it can be used for fine-tuning.

```php
    $dataset = $cohereClient->dataset()->get($dataset->id);
```

Refer to the [Cohere dataset GET documentation](https://docs.cohere.com/reference/get-dataset)

---

## 📊 Get Dataset Usage

Use the `getUsage` method to retrieve statistics and usage limits related to your datasets.

This can help you monitor:
- how many datasets you’ve uploaded
- how much storage/usage you’ve consumed
- applicable limits based on your account plan

```php
 $datasetUsage = $cohereClient->dataset()->getUsage();
 var_dump($datasetUsage->organisationUsage);
```

---

## 📋 List All Datasets

The `list` method allows you to retrieve all datasets currently available in your Cohere account.

You can filter and inspect available datasets by type, status, or name manually after retrieving the list.

```php
$datasets = $cohereClient->dataset()->list();
```

---

## ❌ Delete a Dataset

You can delete a dataset using the `delete` method by providing the dataset ID.

🛑 **Warning**: This action is irreversible. Deleted datasets cannot be recovered.

```php
   $cohereClient->dataset()->delete($dataset->id);
```