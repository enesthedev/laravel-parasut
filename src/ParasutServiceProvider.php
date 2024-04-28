<?php

namespace Enes\Parasut;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Enes\Parasut\Commands\ParasutCommand;

class ParasutServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-parasut')
            ->hasConfigFile();
    }
}
