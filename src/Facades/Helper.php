<?php

namespace Guysolamour\Administrable\Extensions\Shop\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Helepr
 *
 * @method static \Guysolamour\Administrable\Helper shopSettings(?string $attribute = null, string $default = null)
 *
 */
class Helper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'administrable-shop-helper';
    }
}
