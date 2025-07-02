### Chat Completion

This method allows you to generate a chat-based response using Cohere's `/chat` endpoint, which supports multi-turn conversations.

```php
$chat = $cohereClient->chat()->create(messages: [
    ['role' => 'user', 'content' => 'Hello Cohere !']
]);

var_dump($chat->message);
```

#### Parameters

- `messages` (required):  
  An array of message objects representing the conversation history.  
  Each message must be an associative array with the following structure:
    - `role`: either `'user'`, `'system'`, or `'assistant'`
    - `content`: the message text

- `params` (optional):  
  An associative array of additional parameters supported by the Cohere `/chat` endpoint.  
  These may include:
    - `model`: (string) The model to use (e.g., `'command-r-plus'`)
    - `citation_options`: (array) Options for controlling citation generation.
    - `max_tokens`: (int) Maximum number of tokens in the response
    - ...

For the complete list of supported options and request format, refer to the official documentation:

👉 [Cohere Chat API Documentation](https://docs.cohere.com/reference/chat)