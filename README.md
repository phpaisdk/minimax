# MiniMax provider for PHP AI SDK

```bash
composer require aisdk/minimax
```

```php
use AiSdk\Generate;
use AiSdk\MiniMax;

MiniMax::create(['apiKey' => $_ENV['MINIMAX_API_KEY']]);

$result = Generate::text('Write a concise release note.')
    ->model(MiniMax::model('MiniMax-M3'))
    ->run();
```

This package uses MiniMax's official OpenAI-compatible `/v1/chat/completions` API. It supports text and streaming generation, tool calling, structured output, reasoning, and MiniMax M3 image/video input. See [MiniMax API docs](https://platform.minimax.io/docs/guides/text-generation) and [PHP AI SDK documentation](https://phpaisdk.com/docs/minimax).
