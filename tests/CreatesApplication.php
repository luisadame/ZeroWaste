<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Laravel\Telescope\Telescope;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        Telescope::ignoreMigrations();

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
