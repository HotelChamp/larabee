<?php

namespace Hotelchamp\Larabee\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Hotelchamp\Larabee\ServiceProvider;

class TestCase extends Orchestra
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @inheritDoc
     */
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }
}
