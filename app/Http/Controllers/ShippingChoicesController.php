<?php

namespace App\Http\Controllers;


use App\Services\ShippingOption;
use App\Services\ShippingChoice;

class ShippingChoicesController extends Controller
{

    public function index()
    {
        return response()->json((new ShippingChoice(new ShippingOption()))->orderedShippping());
    }
}
