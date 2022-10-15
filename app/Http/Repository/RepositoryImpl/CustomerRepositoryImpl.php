<?php

namespace App\Http\Repository\RepositoryImpl;

use App\Http\Repository\CustomerRepository;
use App\Models\Customer;

class CustomerRepositoryImpl implements CustomerRepository
{

    public function create(Customer $customer, $data=[])
    {
        // TODO: Implement create() method.
        return $customer->create($customer);
    }

    public function update(Customer $customer, $data=[])
    {
        // TODO: Implement update() method.
    }

    public function read(Customer $customer)
    {
        // TODO: Implement read() method.
    }

    public function readById(Customer $customer, $id)
    {
        // TODO: Implement readById() method.
    }
}
