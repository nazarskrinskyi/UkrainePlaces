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
            $parameters['lang'] = $locale;
        }

        return route($name, $parameters, $absolute);
    }
}
