<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use App\Models\Vendor\Customer;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Customers\API\RegisterCustomerRequest;

class CustomerController extends Controller
{
    use ApiResponse;

    public function registerCustomer(RegisterCustomerRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $user = Customer::createNew($validatedData['first_name'], $validatedData['last_name'], $validatedData['email'], $validatedData['password']);
            $user->token = $user->createToken('Customer-Token')->plainTextToken;

            return $this->successResponse($user, "Your account has been registered successful.", Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Something went wrong!");
        }
    }
}
