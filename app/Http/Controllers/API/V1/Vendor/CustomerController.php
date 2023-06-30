<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Vendor\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Customers\LoginRequest;
use App\Http\Requests\Vendor\Customers\API\RegisterCustomerRequest;

class CustomerController extends Controller
{
    use ApiResponse;

    public function register(RegisterCustomerRequest $request)
    {
        $data = [];
        $validatedData = $request->validated();
        try {
            $user = Customer::createNew($validatedData['first_name'], $validatedData['last_name'], $validatedData['email'], $validatedData['password']);
            $token = $user->createToken('Customer-Token')->plainTextToken;

            $data['user'] = $user;
            $data['tokenType'] = 'Bearer';
            $data['token'] = $token;

            return $this->successResponse($data, "Your account has been registered successfull.", Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Something went wrong!");
        }
    }

    public function login(LoginRequest $request)
    {
        $data = [];
        try {
            // Retrieve the user by the provided credentials.
            $user = Customer::where('email', $request->email)->first();

            // Check if the user exists and the provided password matches the one in the database.
            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->errorResponse("The provided credentials are incorrect.", Response::HTTP_UNAUTHORIZED);
            }

            // Delete any previous tokens
            $user->tokens()->delete();

            // Create a new token
            $token = $user->createToken('Customer-Token')->plainTextToken;
            $data['user'] = $user;
            $data['tokenType'] = 'Bearer';
            $data['token'] = $token;

            return $this->successResponse($data, "Login successfull.", Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Login failed.");
        }
    }

    public function logout(Request $request)
    {
        try {
            // Get the authenticated user
            $user = $request->user();

            // Revoke the user's current token
            $user->currentAccessToken()->delete();

            return $this->successResponse([], "Logout successfull.", Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Logout failed.");
        }
    }
}
