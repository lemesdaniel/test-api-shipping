<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingOption
{
    private string $url;

    public function __construct()
    {
        $this->url = config('shipping_options.url');
    }

    public function get()
    {
        return Http::get($this->url)->object();
    }

}
