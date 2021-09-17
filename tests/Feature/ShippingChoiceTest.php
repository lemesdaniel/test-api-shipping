<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\ShippingChoice;
use Tests\TestCase;

class ShippingChoiceTest extends TestCase
{

    /**
     * @test
     * @dataProvider dataProvider
     * @return void
     */
    public function CheckShippingCostsAndEstimatedDelivery($data, $expected)
    {
        $orderedShipping = new ShippingChoice($data);

        $this->assertEquals(
            $expected,
            json_encode($orderedShipping->orderedShippping())
        );
    }


    public function dataProvider(): array
    {
        return [
            [
                json_decode(
                    '{
            "shipping_options": [{"name":"Option 1","type":"Delivery","cost":10,"estimated_days":5},
{"name":"Option 2","type":"Custom","cost":10,"estimated_days":2},
{"name":"Option 3","type":"Pickup","cost":10,"estimated_days":3}]}'
                ),
                '[{"name":"Option 2","type":"Custom","cost":10,"estimated_days":2},{"name":"Option 3","type":"Pickup","cost":10,"estimated_days":3},{"name":"Option 1","type":"Delivery","cost":10,"estimated_days":5}]'
            ],
            [
                json_decode(
                    '{
            "shipping_options": [{"name":"Option 1","type":"Delivery","cost":6,"estimated_days":3},
{"name":"Option 2","type":"Custom","cost":5,"estimated_days":3},
{"name":"Option 3","type":"Pickup","cost":10,"estimated_days":3}]}'
                ),
                '[{"name":"Option 2","type":"Custom","cost":5,"estimated_days":3},{"name":"Option 1","type":"Delivery","cost":6,"estimated_days":3},{"name":"Option 3","type":"Pickup","cost":10,"estimated_days":3}]'
            ],
            [
                json_decode(
                    '{
            "shipping_options": [{"name":"Option 4","type":"Delivery","cost":10,"estimated_days":3},
            {"name":"Option 1","type":"Delivery","cost":10,"estimated_days":5},
            {"name":"Option 2","type":"Custom","cost":5,"estimated_days":4},
            {"name":"Option 3","type":"Pickup","cost":7,"estimated_days":1}]
          }'
                ),
                '[{"name":"Option 2","type":"Custom","cost":5,"estimated_days":4},{"name":"Option 3","type":"Pickup","cost":7,"estimated_days":1},{"name":"Option 4","type":"Delivery","cost":10,"estimated_days":3},{"name":"Option 1","type":"Delivery","cost":10,"estimated_days":5}]'
            ],
            [
                json_decode(
                    '{"shipping_options": [{"name":"Option 1","type":"Delivery","cost":10,"estimated_days":3},
                            {"name":"Option 2","type":"Custom","cost":10,"estimated_days":3},
                            {"name":"Option 3","type":"Pickup","cost":10,"estimated_days":3}]}'
                ),
                '[{"name":"Option 1","type":"Delivery","cost":10,"estimated_days":3},{"name":"Option 2","type":"Custom","cost":10,"estimated_days":3},{"name":"Option 3","type":"Pickup","cost":10,"estimated_days":3}]'
            ]
        ];
    }
}
