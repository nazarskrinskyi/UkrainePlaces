<?php

declare(strict_types=1);

namespace App\Support;

class UrlHelper
{
    public static function localizedRoute(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        $locale = app()->getLocale();
        $defaultLocale = 'uk';

        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }

        if ($locale !== $defaultLocale) {
            $parameters['lang'] = $locale;
        }

        return route($name, $parameters, $absolute);
    }

}
