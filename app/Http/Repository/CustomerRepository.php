<?php

namespace App\Http\Repository;

use App\Models\Customer;

interface CustomerRepository
{
    public function create(Customer $customer, $data=[]);
    public function update(Customer $customer, $data=[]);
    public function read(Customer $customer);
    public function readById(Customer $customer, $id);
}
