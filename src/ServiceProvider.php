<?php

namespace Guysolamour\Administrable\Extensions\Shop;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\AliasLoader;
use Guysolamour\Administrable\Extensions\Shop\Services\Shop;
use Guysolamour\Administrable\Extensions\Shop\Models\Cart;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const PACKAGE_NAME = 'administrable-shop';

    public function boot()
    {
        $this->app->bind(self::PACKAGE_NAME . '-helper', fn () => new Helper);
        $this->app->bind(self::PACKAGE_NAME . '-cart', fn () => new Cart);
        $this->app->bind(self::PACKAGE_NAME, fn () => new Shop);


        $this->publishes([
            static::packagePath("config/" . self::PACKAGE_NAME . ".php") => config_path(self::PACKAGE_NAME . '.php'),
        ], self::PACKAGE_NAME . '-config');

        $this->publishes([
            static::packagePath('resources/lang') => $this->app->langPath('vendor/' . static::PACKAGE_NAME),
        ], static::PACKAGE_NAME . '-lang');


        $this->registerEvents();

        $this->loadHelperFile();

        $this->loadRoutesFrom(static::packagePath("/routes/back.php"));
        $this->loadRoutesFrom(static::packagePath("/routes/front.php"));

        $this->loadTranslationsFrom(static::packagePath('resources/lang'), static::PACKAGE_NAME);

        $this->loadMigrationsFrom([
            config(self::PACKAGE_NAME . '.migrations_path'),
        ]);

        $this->loadViewsFrom(static::packagePath('/resources/views/front'), self::PACKAGE_NAME);
        $this->loadViewsFrom(static::packagePath('/resources/views/back/' . Str::lower(config('administrable.theme'))), self::PACKAGE_NAME);
    }


    private function registerEvents(): void
    {
        Event::listen(
            \Guysolamour\Administrable\Extensions\Shop\Events\ConfirmCommandPayment::class,
            [\Guysolamour\Administrable\Extensions\Shop\Listeners\CreateCommandOrder::class, 'handle']
        );
        Event::listen(
            \Guysolamour\Administrable\Extensions\Shop\Events\ConfirmCommandPayment::class,
            [\Guysolamour\Administrable\Extensions\Shop\Listeners\IncrementProductSoldCount::class, 'handle']
        );
    }

    private function loadHelperFile(): void
    {
        require static::packagePath('/src/Helpers/helpers.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            static::packagePath('config/' . self::PACKAGE_NAME . '.php'),
            self::PACKAGE_NAME
        );

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();

            $loader->alias('Cart', \Guysolamour\Administrable\Extensions\Shop\Facades\Cart::class);
            $loader->alias('Shop', \Guysolamour\Administrable\Extensions\Shop\Facades\Shop::class);
        });
    }

    public static function packagePath(string $path = ''): string
    {
        return  __DIR__ . '/../' . $path;
    }
}
