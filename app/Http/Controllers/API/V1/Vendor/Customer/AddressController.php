<?php

namespace App\Http\Controllers\API\V1\Vendor\Customer;

use App\Traits\ApiResponse;
use App\Models\Vendor\Address;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Customers\API\Address\StoreAddressRequest;

/**
 * @tags Customer
 */
class AddressController extends Controller
{
    use ApiResponse;

    public function storeAddress(StoreAddressRequest $request)
    {
        // Get the authenticated user's ID
        $customerId = $request->user()->id;

        try {
            $address = Address::storeForCustomer($request->validated(), $customerId);
            return $this->successResponse($address, "Addresss saved successfully.", Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Failed to save address.");
        }
    }
}
