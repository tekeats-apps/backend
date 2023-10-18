<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Vendor\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\TenantImageUploadTrait;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Customers\LoginRequest;
use App\Http\Requests\Vendor\Customers\ProfileUpdateRequest;
use App\Http\Requests\Vendor\Customers\PasswordUpdateRequest;
use App\Http\Requests\Vendor\Customers\API\RegisterCustomerRequest;

class CustomerController extends Controller
{
    use ApiResponse, TenantImageUploadTrait;

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

            return $this->successResponse($data, "Your account has been registered successfully.", Response::HTTP_CREATED);
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

            return $this->successResponse($data, "Login successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Login failed.");
        }
    }

    public function getProfile(Request $request)
    {
        try {
            $user = $request->user(); // Get the authenticated user.

            return $this->successResponse($user, "Profile fetched successfully.", Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch profile.");
        }
    }


    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {

            $user = $request->user();
            $validatedData = $request->validated();

            $user->fill($validatedData);
            $user->save();

            if (isset($validatedData['avatar']) && !empty($validatedData['avatar'])) {
                $avatar = $validatedData['avatar'];
                $module = Customer::IMAGE_PATH; // Assuming 'users' is the module name
                $recordId = $user->id; // Assuming the user's ID is the record ID
                $tableField = 'avatar';
                $tableName = 'customers';

                if ($user->avatar) {
                    $this->delete_image_by_name($module, $user->avatar);
                }

                // Upload the image and get the image URL
                $this->uploadImage($avatar, $module, $recordId, $tableField, $tableName);
            }

            return $this->successResponse($user, "Profile updated successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Profile update failed.");
        }
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        try {
            $user = $request->user();
            $currentPassword = $request->get('current_password');
            $newPassword = $request->get('new_password');

            if (!Hash::check($currentPassword, $user->password)) {
                return $this->errorResponse("Provided old password is incorrect.", Response::HTTP_UNAUTHORIZED);
            }

            $user->password = Hash::make($newPassword);
            $user->save();

            return $this->successResponse([], "Password updated successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Password update failed.");
        }
    }


    public function logout(Request $request)
    {
        try {
            // Get the authenticated user
            $user = $request->user();

            // Revoke the user's current token
            $user->currentAccessToken()->delete();

            return $this->successResponse([], "Logout successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Logout failed.");
        }
    }
}
