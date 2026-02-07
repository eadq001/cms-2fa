<?php

namespace Core\Middleware;

class Middleware
{
    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key) {
        $middleware = static::MAP[$key] ?? null;

        if (! $middleware) {
            throw new \Exception("key for '{$key}' does not exist.");
        }

        (new $middleware)->handle();
    }
}
