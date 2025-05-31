<?php

declare(strict_types=1);

namespace App\Support;

class UrlHelper
{
    public static function localizedRoute(string $name, array|int $parameters = [], bool $absolute = true): string
    {
        if (is_int($parameters)) {
            $parameters = ['id' => $parameters];
        }

        $locale = app()->getLocale();
        $defaultLocale = 'uk';

        if ($locale !== $defaultLocale) {
            $parameters['locale'] = $locale;
        }

        $url = route($name, $parameters, $absolute);
        $parsed = parse_url($url);

        $scheme = $parsed['scheme'] ?? 'http';
        $host = $parsed['host'] ?? request()->getHost();
        $port = isset($parsed['port']) ? ':' . $parsed['port'] : '';
        $query = isset($parsed['query']) ? '?' . $parsed['query'] : '';
        $path = $parsed['path'] ?? '';

        if ($locale !== $defaultLocale && !str_starts_with($path, "/$locale/")) {
            $path = str_replace('en/en', 'en', '/' . $locale . '/' . ltrim($path, '/'));
        }

        $path = preg_replace('#/+#', '/', $path);

        return "$scheme://$host$port$path$query";
    }
}
