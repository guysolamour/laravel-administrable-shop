<?php

namespace Guysolamour\Administrable\Extensions\Shop;

class Helper
{
    public function formatPrice($price, string $suffix = '')
    {
        return number_format($price, 0, ',', ' ') . " {$suffix}";
    }

}
