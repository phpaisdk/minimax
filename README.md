# PHP AI SDK — MiniMax

Text generation, streaming, reasoning, and tool calling with MiniMax. Part of the framework-agnostic [PHP AI SDK](https://phpaisdk.com).

## Installation

```bash
composer require aisdk/minimax
```

Set `MINIMAX_API_KEY` in your environment.

## Usage

```php
use AiSdk\Generate;
use AiSdk\MiniMax;

$result = Generate::text('Explain closures in PHP in one sentence.')
    ->model(MiniMax::model('MiniMax-M3.1-Flash'))
    ->run();

echo $result->text;
```

## Documentation

[Read the documentation](https://phpaisdk.com/docs/0.x/providers/minimax) for configuration, supported features, and more examples.

[Contributing](https://github.com/phpaisdk/.github/blob/main/CONTRIBUTING.md) · [Support](https://github.com/phpaisdk/.github/blob/main/SUPPORT.md)

## License

The MIT License (MIT). See [LICENSE](LICENSE) for details.
