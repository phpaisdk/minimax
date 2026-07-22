# aisdk/minimax

Official MiniMax provider for the PHP AI SDK. Uses MiniMax's OpenAI-compatible Chat Completions API.

```bash
composer require aisdk/minimax
```

## Basic Usage

```php
use AiSdk\Generate;
use AiSdk\MiniMax;

MiniMax::create(['apiKey' => $_ENV['MINIMAX_API_KEY']]);

$result = Generate::text('Write a concise release note.')
    ->model(MiniMax::model('MiniMax-M3'))
    ->run();
```

## Configuration

| Variable | Description | Default |
| --- | --- | --- |
| `MINIMAX_API_KEY` | API key for authentication | Required |
| `MINIMAX_BASE_URL` | Chat Completions API root | `https://api.minimax.io/v1` |

```php
MiniMax::create([
    'apiKey' => $_ENV['MINIMAX_API_KEY'],
    'baseUrl' => 'https://api.minimax.io/v1',
]);
```

## Supported Capabilities

| Capability | Support |
| --- | --- |
| Text generation and streaming | Native OpenAI-compatible chat |
| Tool calling and structured output | Passed through for supported models |
| Reasoning and image input | Passed through for supported models |
| Video input | Not exposed by the shared message converter yet |

## Provider Options

Use `providerOptions('minimax', ['raw' => [...]])` to send documented MiniMax chat-completions fields outside the portable SDK surface. Model IDs are opaque strings and remain validated by MiniMax.

## Documentation

- [MiniMax API documentation](https://platform.minimax.io/docs/guides/text-generation)
- [PHP AI SDK documentation](https://phpaisdk.com/docs/minimax)
