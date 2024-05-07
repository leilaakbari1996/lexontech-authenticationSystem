<?php

namespace Lexontech\AuthenticationSystem;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Lexontech\AuthenticationSystem\database\seeders\AuthenticationSystem\AttributeSeeder;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //seeders
        $this->publishes([
            __DIR__.'/database/seeders' => database_path('seeders'),
        ],'authSeeders');

        //migrations
        $this->publishesMigrations([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ],'authMigrations');


        //views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'AuthView');

        //rotes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        //public
        $this->publishes([
            __DIR__.'/public' => public_path('/'),
        ], 'authPublic');

        //seeder
        $seed_list[] = AttributeSeeder::class;
        $this->loadSeeders($seed_list);
    }

    protected function loadSeeders($seed_list)
    {
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seed_list) {
            foreach ((array) $seed_list as $path) {
                $seeder->call($seed_list);
                // here goes the code that will print out in console that the migration was succesful
            }
        });
    }
}
