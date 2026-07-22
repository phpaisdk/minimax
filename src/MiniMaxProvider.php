<?php

declare(strict_types=1);

namespace AiSdk\MiniMax;

use AiSdk\Contracts\BaseProvider;
use AiSdk\Contracts\TextModelInterface;
use AiSdk\Contracts\TextProviderInterface;
use AiSdk\MiniMax\Models\MiniMaxTextModel;

final class MiniMaxProvider extends BaseProvider implements TextProviderInterface
{
    public function __construct(public readonly MiniMaxOptions $options) {}
    public function name(): string
    {
        return MiniMaxOptions::PROVIDER_NAME;
    }
    protected function textModel(string $modelId): TextModelInterface
    {
        return new MiniMaxTextModel($modelId, $this->options);
    }
}
