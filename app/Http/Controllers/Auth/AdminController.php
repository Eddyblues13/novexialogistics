<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('admin.change_password'); // This should match your blade file name
    }

    public function changePassword(Request $request, Admin $admin)
    {
        try {
            // Verify the authenticated admin is changing their own password
            if (auth('admin')->id() !== $admin->id) {
                throw new \Exception('Unauthorized action. You can only change your own password.');
            }

            $request->validate([
                'current_password' => ['required', 'current_password:admin'],
                'new_password' => [
                    'required',
                    'confirmed',
                    Password::min(4)

                ],
            ]);

            // Update the password
            $admin->update([
                'password' => Hash::make($request->new_password)
            ]);

            Log::info("Admin ID {$admin->id} changed their password successfully.");

            return response()->json([
                'type' => 'success',
                'message' => 'Password changed successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            $firstError = collect($errors)->first()[0];

            Log::error('Password change validation failed: ' . $firstError);

            return response()->json([
                'type' => 'validation_error',
                'message' => $firstError,
                'errors' => $errors
            ], 422);
        } catch (\Exception $e) {
            Log::error('Password change error for Admin ID ' . $admin->id . ': ' . $e->getMessage());

            return response()->json([
                'type' => 'server_error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
