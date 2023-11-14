<?php

namespace App\Http\Controllers\API\V1\Vendor\Customer;

use App\Traits\ApiResponse;
use App\Models\Vendor\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Customers\API\Address\StoreAddressRequest;

/**
 * @tags Customer
 */
class AddressController extends Controller
{
    use ApiResponse;

    /**
     * Store Address
     *
     * 🚀 This endpoint allows customers to store address. That will help customer to use while placing Delivery Orders!
     */
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

    /**
     * Get Customer Addresses
     *
     * 🚀 This endpoint allows customers to retrieve their saved addresses.
     */
    public function getCustomerAddresses(Request $request)
    {
        // Get the authenticated user's ID
        $customerId = $request->user()->id;

        try {
            $addresses = Address::where('customer_id', $customerId)->get();
            return $this->successResponse($addresses, "Customer addresses retrieved successfully.");
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Failed to retrieve customer addresses.");
        }
    }

    /**
     * Update Address
     *
     * 🚀 This endpoint allows customers to update their saved address.
     */
    public function updateAddress(UpdateAddressRequest $request, $addressId)
    {
        // Get the authenticated user's ID
        $customerId = $request->user()->id;

        try {
            $address = Address::findOrFail($addressId);

            // Check if the address belongs to the authenticated customer
            if ($address->customer_id !== $customerId) {
                return $this->errorResponse("Unauthorized to update this address.", Response::HTTP_UNAUTHORIZED);
            }

            // Update the address with validated data
            $address->update($request->validated());

            return $this->successResponse($address, "Address updated successfully.");
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Failed to update address.");
        }
    }

    /**
     * Delete Address
     *
     * 🚀 This endpoint allows customers to delete their saved address.
     */
    public function deleteAddress(Request $request, $addressId)
    {
        // Get the authenticated user's ID
        $customerId = $request->user()->id;

        try {
            $address = Address::findOrFail($addressId);

            // Check if the address belongs to the authenticated customer
            if ($address->customer_id !== $customerId) {
                return $this->errorResponse("Unauthorized to delete this address.", Response::HTTP_UNAUTHORIZED);
            }

            // Delete the address
            $address->delete();

            return $this->successResponse(null, "Address deleted successfully.");
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Failed to delete address.");
        }
    }
}
