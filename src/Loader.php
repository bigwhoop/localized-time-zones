<?php
declare(strict_types=1);

namespace Bigwhoop\LocalizedTimeZones;

final class Loader
{
    public static function all(string $locale = 'en_US', bool $fallbackToRegion = true): array
    {
        if (null !== ($data = self::load($locale))) {
            return $data;
        }
        
        if ($fallbackToRegion && null !== ($data = self::load(explode('_', $locale)[0]))) {
            return $data;
        }
        
        throw new Exception("No data found for locale '{$locale}'.");
    }
    
    public static function one(string $timeZone, string $locale = 'en_US', bool $fallbackToRegion = true): string
    {
        $name = self::all($locale, $fallbackToRegion)[$timeZone] ?? null;
        
        if ($name !== null) {
            return $name;
        }
        
        throw new Exception("No label for time zone '{$timeZone}' found for locale '{$locale}'.");
    }
    
    private static function load(string $id): ?array
    {
        $path = __DIR__ . '/../data/' . $id . '.php';
        if (!file_exists($path)) {
            return null;
        }
        
        return require $path;
    }
}