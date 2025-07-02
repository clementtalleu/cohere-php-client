### Embed Job

This method allows you to launch a background job to embed an entire dataset using Cohere’s `/embed-jobs` endpoint.

It is designed for large-scale embedding, typically used with uploaded datasets.

To create :
```php
     $embedJob = $cohereClient->embedJob()->create(
            datasetId: 'embed-input-kwsse8',
            inputType: 'classification',
            params: ['model' => 'embed-multilingual-v3.0']
        );

        var_dump($embedJob->jobId);
```

#### Parameters

- `datasetId` (required):  
  The ID of the dataset previously uploaded to Cohere that you want to embed.

- `inputType` (required):  
  A string describing the type of input for embedding.  
  Example values: `'search_document'`, `'classification'`, `'clustering'`, etc.

- `params` (optional):  
  An associative array of additional options supported by the `/embed-jobs` endpoint.  
  These may include:
  - `model`: (string) The embedding model to use, such as `'embed-multilingual-v3.0'`
  - ...

#### Response

Returns an object containing the job ID and metadata to monitor the embedding job progress.

You can also retrieve an embed job or the complete list by
```php
 $embedJobs = $cohereClient->embedJob()->list();
 $embedJob = $cohereClient->embedJob()->get('embed-job-id');
```

📄 For full reference, see the official documentation:  
👉 [Cohere Embed Jobs API](https://docs.cohere.com/reference/create-embed-job)