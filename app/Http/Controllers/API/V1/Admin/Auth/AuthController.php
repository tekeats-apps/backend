<?php

namespace App\Http\Controllers\API\V1\Admin\Auth;

use Exception;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\TenantImageUploadTrait;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\Api\Auth\LoginRequest;
use App\Http\Requests\Admin\Api\Auth\ProfileUpdateRequest;
use App\Http\Requests\Admin\Api\Auth\PasswordUpdateRequest;
use App\Http\Requests\Admin\Api\Auth\UpdateProfileImageRequest;

/**
 * @tags Admin
 */
class AuthController extends Controller
{
    use ApiResponse, TenantImageUploadTrait;
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
            $user = User::where('email', $request->email)->first();

            // Check if the user exists and the provided password matches the one in the database.
            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->errorResponse("The provided credentials are incorrect.", Response::HTTP_UNAUTHORIZED);
            }

            // Check if the user's status is true
            if ($user->status !== true) {
                return $this->errorResponse("Your account is inactive. Please contact the administrator.", Response::HTTP_UNAUTHORIZED);
            }

            // Create a new token
            $token = $user->createToken('Admin-Token')->plainTextToken;
            $user = $user->only(['name', 'username', 'email', 'image']);
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
            $user = $user->only(['name', 'username', 'email', 'image', 'role']);
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

            $user = $user->only(['name', 'username', 'email', 'image', 'role']);
            return $this->successResponse($user, "Profile updated successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Profile update failed.");
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
     * Update Profile Image
     */
    public function updateProfileImage(UpdateProfileImageRequest $request)
    {
        $validatedData = $request->validated();
        try {

            $user = $request->user();
            if (isset($validatedData['image']) && !empty($validatedData['image'])) {
                $image = $validatedData['image'];
                $module = User::IMAGE_PATH;
                $recordId = $user->id;
                $tableField = 'image';
                $tableName = 'users';

                if ($user->image) {
                    $this->delete_image_by_name($module, $user->image);
                }

                // Upload the image and get the image URL
                $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
                $user = $user->fresh();
            }

            return $this->successResponse($user->image, "Profile image updated successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Profile image update failed.");
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
