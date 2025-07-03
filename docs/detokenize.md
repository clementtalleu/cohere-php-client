### Detokenize

This method allows you to convert token IDs back into a human-readable string using Cohere’s `/detokenize` endpoint.


```php
$detokenize = $cohereClient->detokenize()->create([8466, 5169, 2594, 8, 2792, 43]);

var_dump($detokenize->text);
```


#### Parameters

- `tokens` (required):  
  An array of integer token IDs to be detokenized into a string.  
  These should be valid token IDs previously obtained via the `/tokenize` endpoint or any other compatible method.

#### Returns

A DTO containing:
- `text` (`string`) – The reconstructed string corresponding to the given token IDs.
- `meta` (`array`) – Metadata, including API version information.

#### Notes

- Useful for validating the result of tokenized input or understanding how token sequences reconstruct into text.
- Should be used in conjunction with `tokenize()` for full round-trip verification or analysis.
- Token IDs must match the tokenizer’s vocabulary (e.g., obtained from the same model family).

For the complete list of supported options and expected format, refer to the official documentation:

👉 [Cohere Detokenize API Documentation](https://docs.cohere.com/reference/detokenize)