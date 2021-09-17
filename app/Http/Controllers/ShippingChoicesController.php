<?php

namespace App\Http\Controllers;


use App\Services\ShippingOption;
use App\Services\ShippingChoice;

class ShippingChoicesController extends Controller
{

    public function index()
    {
        $options = (new ShippingOption())->get();
        return response()->json((new ShippingChoice($options))->orderedShippping());
    }
}
