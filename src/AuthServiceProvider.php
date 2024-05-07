<?php

namespace Lexontech\AuthenticationSystem;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Lexontech\AuthenticationSystem\app\Infrastructures\Message;
use Lexontech\AuthenticationSystem\app\Infrastructures\Transfer;
use Lexontech\AuthenticationSystem\database\seeders\AuthenticationSystem\AttributeSeeder;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);

        // Get the AliasLoader instance
        $loader = AliasLoader::getInstance();

        // Add your aliases
        $loader->alias('ReturnMessage', \Lexontech\Root\app\Facades\Root\Message::class);
        $loader->alias('TransferFacade', \Lexontech\Root\app\Facades\Root\Transfer::class);

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

        App::alias(Message::class, 'ReturnMessage');
        App::alias(Transfer::class, 'TransferFacade');

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
