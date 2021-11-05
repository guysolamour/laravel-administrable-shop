<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;


use Illuminate\Support\Str;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class ShopController extends BaseController
{
    public function settings()
    {
        /**
         * @var \Guysolamour\Administrable\Settings\BaseSettings
         */
        $settings = shop_settings();

        $products = config('administrable-shop.models.product')::principal()->last()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.settings.index', compact('settings', 'products'));
    }
}
