<?php

declare(strict_types=1);

namespace AiSdk;

use AiSdk\Contracts\Model;
use AiSdk\MiniMax\MiniMaxOptions;
use AiSdk\MiniMax\MiniMaxProvider;

final class MiniMax
{
    private static ?MiniMaxProvider $default = null;
    /** @param array<string, mixed> $config */ public static function create(array $config = []): MiniMaxProvider
    {
        return self::$default = new MiniMaxProvider(MiniMaxOptions::fromArray($config));
    }
    public static function default(): MiniMaxProvider
    {
        return self::$default ??= self::create();
    }
    public static function reset(): void
    {
        self::$default = null;
    }
    public static function model(string $modelId): Model
    {
        return self::default()->model($modelId);
    }
}
