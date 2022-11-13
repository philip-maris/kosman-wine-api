<?php


class CustomerTest extends \Tests\TestCase
{


    public function test_read_by_id(){
        $service = new \App\Http\Controllers\V1\CustomersController(new \App\Http\Service\Vi\Api\CustomerService());
        $service->read();
    }
}
