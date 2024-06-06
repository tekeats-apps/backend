<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Customer\CustomerRepository;

class CustomerService
{
    protected CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function getCustomerList()
    {
        return $this->customerRepository->listCustomers();
    }

}