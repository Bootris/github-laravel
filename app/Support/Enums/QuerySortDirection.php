<?php

namespace App\Support\Enums;

enum QuerySortDirection: string
{
    case Recent = 'recent';
    case Past = 'past';

    public static function names(): array
    {
        return array_column(self::cases(), 'value');
    }
}
