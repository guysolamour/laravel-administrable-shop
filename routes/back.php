<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::prefix(config('administrable.auth_prefix_path') . "/extensions/") ->middleware([Str::lower(config('administrable.guard')) . '.auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Shop
    |--------------------------------------------------------------------------
    */
    Route::name(Str::lower(config('administrable.back_namespace')) . '.extensions.shop.')->group(function () {
        Route::prefix('shop')->group(function () {

            Route::get('settings', [config('administrable-shop.controllers.back.setting'), 'edit'])->name('settings');
            Route::put('settings', [config('administrable-shop.controllers.back.setting'), 'update'])->name('settings.update');

            Route::resource('products', config('administrable-shop.controllers.back.product'))->names([
                'index'      => 'product.index',
                'create'     => 'product.create',
                'show'       => 'product.show',
                'store'      => 'product.store',
                'edit'       => 'product.edit',
                'update'     => 'product.update',
                'destroy'    => 'product.destroy',
            ])->except(['show']);

            // JS
            Route::post('commands/{command}/addproduct', [config('administrable-shop.controllers.back.command'), 'addProduct']);
            Route::post('commands/{command}/applydiscount', [config('administrable-shop.controllers.back.command'), 'applyDiscount']);
            Route::delete('commands/{command}/products', [config('administrable-shop.controllers.back.command'), 'removeProduct']);
            Route::put('commands/{command}/products', [config('administrable-shop.controllers.back.command'), 'updateProduct']);
            // END JS

            Route::get('statistic', [config('administrable-shop.controllers.back.command'), 'statistic'])->name('statistic.index');

            Route::post('commands/{command}/confirm', [config('administrable-shop.controllers.back.command'), 'confirmPayment'])->name('command.confirm');

            Route::resource('commands', config('administrable-shop.controllers.back.command'))->names([
                'index'      => 'command.index',
                'create'     => 'command.create',
                'show'       => 'command.show',
                'store'      => 'command.store',
                'edit'       => 'command.edit',
                'update'     => 'command.update',
                'destroy'    => 'command.destroy',
            ])->except(['show']);

            Route::resource('orders', config('administrable-shop.controllers.back.order'))->names([
                'index'      => 'order.index',
                'create'     => 'order.create',
                'show'       => 'order.show',
                'store'      => 'order.store',
                'edit'       => 'order.edit',
                'update'     => 'order.update',
                'destroy'    => 'order.destroy',
            ])->only(['index']);

            Route::resource('categories', config('administrable-shop.controllers.back.category'))->names([
                'index'      => 'category.index',
                'create'     => 'category.create',
                'show'       => 'category.show',
                'store'      => 'category.store',
                'edit'       => 'category.edit',
                'update'     => 'category.update',
                'destroy'    => 'category.destroy',
            ]);

            Route::resource('brands', config('administrable-shop.controllers.back.brand'))->names([
                'index'      => 'brand.index',
                'create'     => 'brand.create',
                'show'       => 'brand.show',
                'store'      => 'brand.store',
                'edit'       => 'brand.edit',
                'update'     => 'brand.update',
                'destroy'    => 'brand.destroy',
            ]);

            Route::resource('users', config('administrable-shop.controllers.back.client'))->names([
                'index'      => 'user.index',
                'create'     => 'user.create',
                'show'       => 'user.show',
                'store'      => 'user.store',
                'edit'       => 'user.edit',
                'update'     => 'user.update',
                'destroy'    => 'user.destroy',
            ])->except(['destroy']);

            Route::resource('attributes', config('administrable-shop.controllers.back.attribute'))->names([
                'index'      => 'attribute.index',
                'create'     => 'attribute.create',
                'show'       => 'attribute.show',
                'store'      => 'attribute.store',
                'edit'       => 'attribute.edit',
                'update'     => 'attribute.update',
                'destroy'    => 'attribute.destroy',
            ]);

            Route::resource('coupons', config('administrable-shop.controllers.back.coupon'))->names([
                'index'      => 'coupon.index',
                'create'     => 'coupon.create',
                'show'       => 'coupon.show',
                'store'      => 'coupon.store',
                'edit'       => 'coupon.edit',
                'update'     => 'coupon.update',
                'destroy'    => 'coupon.destroy',
            ])->except(['show']);

            Route::resource('delivers', config('administrable-shop.controllers.back.deliver'))->names([
                'index'      => 'deliver.index',
                'create'     => 'deliver.create',
                'show'       => 'deliver.show',
                'store'      => 'deliver.store',
                'edit'       => 'deliver.edit',
                'update'     => 'deliver.update',
                'destroy'    => 'deliver.destroy',
            ]);

            Route::resource('coverageareas', config('administrable-shop.controllers.back.coveragearea'))->names([
                'index'      => 'coveragearea.index',
                'create'     => 'coveragearea.create',
                'show'       => 'coveragearea.show',
                'store'      => 'coveragearea.store',
                'edit'       => 'coveragearea.edit',
                'update'     => 'coveragearea.update',
                'destroy'    => 'coveragearea.destroy',
            ]);

            Route::resource('reviews', config('administrable-shop.controllers.back.review'))->names([
                'index'      => 'review.index',
                'create'     => 'review.create',
                'show'       => 'review.show',
                'store'      => 'review.store',
                'edit'       => 'review.edit',
                'update'     => 'review.update',
                'destroy'    => 'review.destroy',
            ]);

            Route::post('reviews/{review}/approve', [config('administrable-shop.controllers.back.review'), 'approve'])->name('review.approve');
        });
    });

});
