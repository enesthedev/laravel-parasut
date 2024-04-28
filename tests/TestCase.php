<?php

namespace Enes\Parasut\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Enes\Parasut\ParasutServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ParasutServiceProvider::class,
        ];
    }
}
