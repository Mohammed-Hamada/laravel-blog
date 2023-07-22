<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;


class FirstServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Connection::class, fn(Application $app) => new Connection(config('database')));
    }

}