<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back;


use Illuminate\Support\Str;
use Guysolamour\Administrable\Http\Controllers\BaseController;


class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = config('administrable-shop.models.order')::with('client')->latest()->get();

        return view('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.orders.index', compact('orders'));
    }
}
