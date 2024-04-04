<?php

namespace App\Repositories\Platform\Customer;

use App\Models\Vendor\Customer;
use App\Repositories\Platform\Customer\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected Customer $model;

    public function __construct(Customer $category)
    {
        $this->model = $category;
    }

    public function listCustomers($sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model->orderBy($sortField, $sortDirection);
    }
}
