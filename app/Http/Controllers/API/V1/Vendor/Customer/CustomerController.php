<?php

namespace App\Http\Controllers\API\V1\Vendor\Customer;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Vendor\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Customers\API\GetCustomerOrders;
use Illuminate\Support\Facades\Hash;
use App\Traits\TenantImageUploadTrait;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Customers\LoginRequest;
use App\Http\Requests\Vendor\Customers\PasswordUpdateRequest;
use App\Http\Requests\Vendor\Customers\API\ProfileUpdateRequest;
use App\Http\Requests\Vendor\Customers\API\RegisterCustomerRequest;
use App\Http\Requests\Vendor\Customers\API\UpdateProfileImageRequest;

/**
 * @tags Customer, Auth
 */

class CustomerController extends Controller
{
    use ApiResponse, TenantImageUploadTrait;

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Register
     *
     * 🚀 This endpoint allows new customers to create an account and join our awesome platform. You'll receive a token to access other cool features!
     */
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
    /**
     * Login
     *
     * 🗝️ Use this endpoint to log in and gain access to your account. You'll get a token you can use to do even more awesome things!
     */
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
    /**
     * View Profile
     *
     * @authenticated
     *
     * 📚 Fetch all the important stuff about you! This is where you can get to know your account better.
     */
    public function getProfile(Request $request)
    {
        try {
            $user = $request->user(); // Get the authenticated user.
            return $this->successResponse($user, "Profile fetched successfully.", Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch profile.");
        }
    }

    /**
     * Update Profile
     *
     * @authenticated
     *
     * 👤 Spice up your account! Use this endpoint to update your profile details like your name, email, and even your profile picture.
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $validatedData = $request->validated();
        try {

            $user = $request->user();
            $user->fill($validatedData);
            $user->save();

            return $this->successResponse($user, "Profile updated successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Profile update failed.");
        }
    }

    /**
     * Update Profile Image
     */
    public function updateProfileImage(UpdateProfileImageRequest $request)
    {
        $validatedData = $request->validated();
        try {

            $user = $request->user();
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
                $user = $user->fresh();
            }

            return $this->successResponse($user->avatar, "Profile image updated successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Profile image update failed.");
        }
    }
    /**
     * Change Password
     *
     * @authenticated
     *
     * 🔒➡️🔓 Feeling like your password isn't strong enough or just want a change? Use this to make that switch!
     */
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

    /**
     * Get Customer Orders
     *
     * 📋🍽️ Fetch all orders placed by the authenticated customer.
     */
    public function getCustomerOrders(GetCustomerOrders $request)
    {
        $validatedData = $request->validated();
        try {
            $customer_id = $request->user()->id; // Get the authenticated user
            $orders = $this->orderService->getCustomerOrders($customer_id, $validatedData);

            return $this->successResponse($orders, "Customer orders retrieved successfully!");
        } catch (Exception $e) {
            return $this->errorResponse("Oops! Something went wrong. " . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Log Out
     *
     * @authenticated
     *
     * ✌️ Time to say goodbye? Use this endpoint to log out from your account securely. Come back soon!
     */
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
