<?php

namespace Hotelchamp\Larabee;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package
     *
     * @param Package $package
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('larabee')
            ->hasConfigFile();
    }
}
