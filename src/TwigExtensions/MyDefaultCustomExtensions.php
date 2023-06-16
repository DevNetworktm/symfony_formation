<?php

namespace App\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyDefaultCustomExtensions extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('defaultImage', [$this, 'defaultImage'])
        ];
    }

    public function defaultImage(string $path): string
    {
        if (strlen(trim($path)) === 0) return "img.png";
        else return $path;
    }
}