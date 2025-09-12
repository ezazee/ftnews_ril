<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheHelper
{
    public static function remember(string $key, $ttl, \Closure $callback)
    {
        if (config('cache.status')) {
            if (Cache::has($key)) {
                Log::info("CACHE HIT: {$key}");
                return Cache::get($key);
            }

            return Cache::remember($key, $ttl, $callback);
        }

        return $callback();
    }

    public static function forget(string $key): void
    {
        if (config('cache.status')) {
            Cache::forget($key);
        }
    }
}
