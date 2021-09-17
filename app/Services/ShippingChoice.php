<?php

namespace App\Services;


class ShippingChoice
{

    private $shipping;

    public function __construct($shipping)
    {
        $this->shipping = $shipping;
    }

    public function orderedShippping(): array
    {
        if (empty($this->shipping)) {
            return [];
        }

        $newOrder = $this->shipping->shipping_options;
        usort($newOrder, function ($previus, $current) {
            return ($previus->cost - $current->cost) .
                ($previus->estimated_days - $current->estimated_days);
        });

        return $newOrder;
    }

}
