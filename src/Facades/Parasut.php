<?php

namespace Enes\Parasut\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Enes\Parasut\Parasut
 */
class Parasut extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Enes\Parasut\Parasut::class;
    }
}
