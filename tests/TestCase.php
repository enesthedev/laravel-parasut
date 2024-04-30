<?php

namespace Enes\Parasut\Tests;

use Enes\Parasut\ParasutServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ParasutServiceProvider::class,
        ];
    }
}
