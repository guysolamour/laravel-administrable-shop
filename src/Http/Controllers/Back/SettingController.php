<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class SettingController extends BaseController
{
    public function edit()
    {

        $settings  = shop_settings();
        $delivers  = config('administrable-shop.models.deliver')::with('areas')->latest()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.settings.index', compact('settings', 'delivers'));
    }

    public function update(Request $request)
    {
        /**
         * @var \Guysolamour\Administrable\Settings\BaseSettings
         */
        $settings = shop_settings();

        $settings->update($request->all());

        flashy('Les réglages on été enregistrés');

        return back();
    }
}
