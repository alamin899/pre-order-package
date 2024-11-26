<?php

namespace PreOrder\PreOrderBackend;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use PreOrder\Database\Seeders\UserRoleSeeder;

class PreOrderServiceProvider extends ServiceProvider
{
    private string $name = 'setting';

    public static function basePath(string $path): string
    {
        return __DIR__.'/..'.$path;
    }

    public function register()
    {
        $this->mergeConfigFrom(self::basePath("/config/{$this->name}.php"), $this->name);
    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                self::basePath("/config/{$this->name}.php") => config_path("{$this->name}.php"),
            ], "{$this->name}-config");

            $this->publishes([
                self::basePath('/resources/views') => resource_path("views/vendor/{$this->name}"),
            ], "{$this->name}-views");
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->runSeeder();
        }

        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetPublishing();
//        $this->configureMiddleware();
    }

    protected function runSeeder()
    {
        $this->callAfterResolving('db', function () {
            $seeder = $this->app->make(\PreOrder\Database\Seeders\UserRoleSeeder::class);
            $seeder->run();

            $anotherSeeder = $this->app->make(\PreOrder\Database\Seeders\ProductSeeder::class);
            $anotherSeeder->run();
        });
    }


    /**
     * Register the routes.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        Route::group([
            'domain' => config('setting.route_domain', null),
            'prefix' => Str::finish(config('setting.route_path'), '/').'api',
            'namespace' => 'PreOrder\PreOrderBackend\Http\Controllers\API',
            'middleware' => config('setting.api_middleware', null),
        ], function () {
            $this->loadRoutesFrom(self::basePath('/routes/api.php'));
        });

        Route::group([
            'domain' => config('setting.route_domain', null),
            'prefix' => config('setting.route_path'),
            'namespace' => 'PreOrder\PreOrderBackend\Http\Controllers',
            'middleware' => config('setting.middleware', null),
        ], function () {
            $this->loadRoutesFrom(self::basePath('/routes/web.php'));
        });
    }

    protected function registerResources(): void
    {
        $this->loadViewsFrom(self::basePath('/resources/views'), 'pre-order');
    }

    protected function defineAssetPublishing()
    {
        $this->publishes([
            self::basePath('/public') => public_path('vendor/pre-order-backend'),
        ], 'pre-order-assets');
    }

//    protected function configureMiddleware(): void
//    {
//        $kernel = app()->make(Kernel::class);
//    }
}
