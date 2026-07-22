<?php

declare(strict_types=1);
use AiSdk\Generate;
use AiSdk\MiniMax;
use AiSdk\MiniMax\Tests\Fakes\FakeHttpClient;
use AiSdk\Support\Sdk;
use Nyholm\Psr7\Factory\Psr17Factory;

afterEach(function (): void {
    Generate::reset();
    MiniMax::reset();
});
it('uses the official OpenAI-compatible MiniMax endpoint', function (): void {
    $client = new FakeHttpClient(200, json_encode(['id' => 'minimax-chat', 'model' => 'MiniMax-M3', 'choices' => [['message' => ['content' => 'Hello from MiniMax'], 'finish_reason' => 'stop']], 'usage' => ['prompt_tokens' => 3, 'completion_tokens' => 4]]));
    $factory = new Psr17Factory();
    Generate::configure(new Sdk($client, $factory, $factory));
    MiniMax::create(['apiKey' => 'minimax-test']);
    $result = Generate::text('Hi')->model(MiniMax::model('MiniMax-M3'))->run();
    expect($result->text)->toBe('Hello from MiniMax')->and((string) $client->lastRequest?->getUri())->toBe('https://api.minimax.io/v1/chat/completions')->and($client->lastRequest?->getHeaderLine('Authorization'))->toBe('Bearer minimax-test')->and($client->sentBody()['model'])->toBe('MiniMax-M3');
});
it('accepts opaque MiniMax model identifiers', function (): void {
    MiniMax::create(['apiKey' => 'minimax-test']);
    expect(MiniMax::model('private-minimax-model')->modelId())->toBe('private-minimax-model');
});
