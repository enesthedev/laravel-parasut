<?php

namespace Enes\Parasut\Enums;

enum AuthorizationType: string
{
    case PASSWORD = 'password';
    case AUTHORIZATION_CODE = 'authorization_code';

    public static function values(): array
    {
        return collect(self::cases())->pluck('value')->all();
    }
}
