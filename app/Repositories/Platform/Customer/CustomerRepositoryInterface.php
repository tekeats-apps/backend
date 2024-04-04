<?php

namespace App\Repositories\Platform\Customer;

interface CustomerRepositoryInterface
{
    public function listCustomers($sortField = 'id', $sortDirection = 'desc');
}
