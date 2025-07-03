### Tokenize

This method allows you to tokenize a string into its individual tokens using Cohere’s `/tokenize` endpoint.

```php
$tokenize = $cohereClient->tokenize()->create('hello');
var_dump($tokenize->tokens);
```

#### Parameters

- `input` (required):  
  A single string to tokenize.  
  The string will be split into its token components using the default Cohere tokenizer.

#### Returns

A DTO containing:
- `tokenStrings` (`string[]`) – The list of token strings.
- `tokens` (`int[]`) – The token IDs corresponding to each string.
- `meta` (`array`) – Metadata, including API version information.

#### Notes

- This method is useful to **inspect tokenization**, **estimate token cost**, or **debug LLM input breakdown**.
- Does **not require specifying a model**.
- Can be used to prepare for prompt size limits in other API calls.

For the complete list of supported options and expected format, refer to the official documentation:

👉 [Cohere Tokenize API Documentation](https://docs.cohere.com/reference/tokenize)