<?php

declare(strict_types=1);

namespace AiSdk\MiniMax\Models;

use AiSdk\Capability;
use AiSdk\Contracts\BaseModel;
use AiSdk\Contracts\TextModelInterface;
use AiSdk\MiniMax\MiniMaxOptions;
use AiSdk\OpenAICompatible\ChatRequestBuilder;
use AiSdk\OpenAICompatible\ChatResponseParser;
use AiSdk\OpenAICompatible\ChatStreamParser;
use AiSdk\Requests\TextModelRequest;
use AiSdk\Responses\TextModelResponse;
use AiSdk\Utils\Support\Url;
use Generator;

final class MiniMaxTextModel extends BaseModel implements TextModelInterface
{
    private const array CAPABILITIES = [Capability::TextGeneration, Capability::Streaming, Capability::ToolCalling, Capability::StructuredOutput, Capability::Reasoning, Capability::TextInput, Capability::ImageInput, Capability::VideoInput];
    public function __construct(private readonly string $modelId, private readonly MiniMaxOptions $options) {}
    public function provider(): string
    {
        return MiniMaxOptions::PROVIDER_NAME;
    }
    public function modelId(): string
    {
        return $this->modelId;
    }
    public function generate(TextModelRequest $request): TextModelResponse
    {
        $this->ensureTextRequestSupported($request, self::CAPABILITIES);
        $payload = $this->runner($this->options->sdk)->postJson(Url::joinPath($this->options->baseUrl, '/chat/completions'), ChatRequestBuilder::build($this->modelId, $this->provider(), $request, false), $this->options->authHeaders(), $this->provider());

        return ChatResponseParser::parse($payload, $this->provider());
    }
    public function stream(TextModelRequest $request): Generator
    {
        $this->ensureTextRequestSupported($request, self::CAPABILITIES, streaming: true);
        yield from ChatStreamParser::parse($this->runner($this->options->sdk)->postStream(Url::joinPath($this->options->baseUrl, '/chat/completions'), ChatRequestBuilder::build($this->modelId, $this->provider(), $request, true), $this->options->authHeaders(), $this->provider()), $this->provider());
    }
}
