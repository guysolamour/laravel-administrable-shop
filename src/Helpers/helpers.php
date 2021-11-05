<?php

use Guysolamour\Administrable\Facades\Helper;



if (!function_exists('shop_settings')) {
    function shop_settings(?string $attribute = null, string $default = null)
    {
        return Helper::getSettings(config('administrable-shop.models.setting'), $attribute, $default);
    }
}

