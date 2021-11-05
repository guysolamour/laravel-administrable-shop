<?php

namespace Guysolamour\Administrable\Extensions\Shop\Mail\Back;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductSoldOutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;

    public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, Collection $products)
    {
        $this->admin    = $admin;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->from(config('mail.from.address'))
                ->subject('Produits en rupture de stock ' . config('app.name'))
		        ->markdown('administrable-shop::emails.' . Str::lower(config('administrable.back_namespace'))  . '.productsoldout');
    }
}
