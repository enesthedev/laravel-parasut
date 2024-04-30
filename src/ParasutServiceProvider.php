<?php

namespace Enes\Parasut;

use Enes\Parasut\Enums\AuthorizationType;
use Spatie\LaravelPackageTools\Exceptions\InvalidPackage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ParasutServiceProvider extends PackageServiceProvider
{
    /**
     * @throws InvalidPackage
     */
    public function register(): void
    {
        parent::register();

        $this->app->singleton('parasut', function ($app) {
            return new Parasut(new ParasutClient(AuthorizationType::PASSWORD));
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-parasut')
            ->hasConfigFile();
    }
}
