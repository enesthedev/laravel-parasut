<?php

namespace Enes\Parasut\Enums;

enum AuthorizationType: string
{
    case PASSWORD = 'password';

    public static function values(): array
    {
        return collect(self::cases())->pluck('value')->all();
    }
}
