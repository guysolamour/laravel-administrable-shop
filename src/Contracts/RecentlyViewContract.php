<?php

namespace Guysolamour\Administrable\Extensions\Shop\Contracts;

interface RecentlyViewContract
{
    public function getRecentlyViewKey() :string;

    public function getRecentlyViewId() :int;
}

