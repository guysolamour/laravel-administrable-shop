<?php

return [
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Testimonial
    |--------------------------------------------------------------------------
    |
    | The migrations folder in database directory
    */
    'migrations_path' => database_path('extensions/shop'),
    'cart_dbname'       => 'shop_cart',
    'destroy_on_logout' => false,
    /**
     * Where to redirect when cart is empty
     */
    'redirect_empty_cart' => '/',
    /**
     * Each time a product is visited, it is saved as a cookie
     * to display them later in the recently viewed product section.
     */
    'recently_view_cookie_duration'      =>  525600, // one year in minutes
    /**
     * To display the imagemanager for products.
     * To activate a collection remove the false and add a label or to remove a model set the label to false
     */
    'media_collections' => ['front-image' => 'Image du produit', 'back-image' => false, 'images' => 'Gallerie'],
    'custom_fields'   => [
        'product' => [
            // ['name' => 'display_in_slider',      'type' => 'boolean',   'label' => 'Mise en avant sous le menu'],
            // ['name' => 'week_deal',              'type' => 'boolean',   'label' => 'Deal de la semaime'],
            // ['name' => 'tendance',               'type' => 'boolean',   'label' => 'Tendance'],
            // ['name' => 'display_in_home_slider', 'type' => 'boolean',   'label' => "Diaporama page d'accueil"],
        ],
        'settings' => [
            ['name' => 'send_order_confirmed_client_email', 'type' => 'boolean',   'label' => "Envoyer un mail au client lors de la confirmation de la commande"],
        ],
    ],
    'models'  => [
        'brand'          => Guysolamour\Administrable\Extensions\Shop\Models\Brand::class,
        'order'          => Guysolamour\Administrable\Extensions\Shop\Models\Order::class,
        'coupon'         => Guysolamour\Administrable\Extensions\Shop\Models\Coupon::class,
        'review'         => Guysolamour\Administrable\Extensions\Shop\Models\Review::class,
        'product'        => Guysolamour\Administrable\Extensions\Shop\Models\Product::class,
        'command'        => Guysolamour\Administrable\Extensions\Shop\Models\Command::class,
        'setting'        => Guysolamour\Administrable\Extensions\Shop\Settings\ShopSettings::class,
        'deliver'        => Guysolamour\Administrable\Extensions\Shop\Models\Deliver::class,
        'category'       => Guysolamour\Administrable\Extensions\Shop\Models\Category::class,
        'attribute'      => Guysolamour\Administrable\Extensions\Shop\Models\Attribute::class,
        'deliverprice'   => Guysolamour\Administrable\Extensions\Shop\Models\DeliverPrice::class,
        'coveragearea'   => Guysolamour\Administrable\Extensions\Shop\Models\CoverageArea::class,
        'attributeterm'  => Guysolamour\Administrable\Extensions\Shop\Models\AttributeTerm::class,
    ],
    'controllers' => [
        'back' => [
            'brand'         => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\BrandController::class,
            'order'         => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\OrderController::class,
            'client'        => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\ClientController::class,
            'coupon'        => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\CouponController::class,
            'review'        => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\ReviewController::class,
            'product'       => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\ProductController::class,
            'command'       => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\CommandController::class,
            'setting'       => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\SettingController::class,
            'deliver'       => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\DeliverController::class,
            'category'      => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\CategoryController::class,
            'attribute'     => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\AttributeController::class,
            'deliverprice'  => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\DeliverPriceController::class,
            'coveragearea'  => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\CoverageAreaController::class,
            'attributeterm' => Guysolamour\Administrable\Extensions\Shop\Http\Controllers\Back\AttributeTermController::class,
        ]
    ],
    'forms' => [
        'back' => [
            'attribute'     => Guysolamour\Administrable\Extensions\Shop\Forms\Back\AttributeForm::class,
            'brand'         => Guysolamour\Administrable\Extensions\Shop\Forms\Back\BrandForm::class,
            'category'      => Guysolamour\Administrable\Extensions\Shop\Forms\Back\CategoryForm::class,
            'coupon'        => Guysolamour\Administrable\Extensions\Shop\Forms\Back\CouponForm::class,
            'coveragearea'  => Guysolamour\Administrable\Extensions\Shop\Forms\Back\CoverageAreaForm::class,
            'deliver'       => Guysolamour\Administrable\Extensions\Shop\Forms\Back\DeliverForm::class,
            'product'       => Guysolamour\Administrable\Extensions\Shop\Forms\Back\ProductForm::class,
            'review'        => Guysolamour\Administrable\Extensions\Shop\Forms\Back\ReviewForm::class,
        ]
    ],
    'notifications' => [
        'back' => [
            'commandsent' => Guysolamour\Administrable\Extensions\Shop\Notifications\Back\CommandSentNotification::class,
        ],
    ],
];
