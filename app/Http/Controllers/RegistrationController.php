<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    /**
     * Show the registration form
     */
    public function create()
    {
        return view('home.register');
    }

    /**
     * Store a newly created package
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Sender Information
                'sender_name' => 'required|string|max:255',
                'shipping_from' => 'required|string|max:255',

                // Receiver Information
                'receiver_name' => 'required|string|max:255',
                'receiver_phone' => 'required|string|max:20',
                'receiver_country' => 'required|string|max:255',
                'receiver_address' => 'required|string|max:500',
                'receiver_age' => 'nullable|integer|min:1|max:120',

                // Package Details
                'tracking_number' => 'required|string|max:255|unique:packages',
                'amount' => 'required|numeric|min:0',
                'item_description' => 'nullable|string|max:500',
                'notes' => 'nullable|string',
            ]);

            // Generate tracking number if not provided or ensure it's unique
            $trackingNumber = $validated['tracking_number'];
            if (Package::where('tracking_number', $trackingNumber)->exists()) {
                $trackingNumber = 'PKG' . Str::upper(Str::random(10));
            }

            // Create the package with minimal required fields
            $package = Package::create([
                'tracking_number' => $trackingNumber,
                'sender_name' => $validated['sender_name'],
                'receiver_name' => $validated['receiver_name'],
                'receiver_phone' => $validated['receiver_phone'],
                'receiver_country' => $validated['receiver_country'],
                'receiver_address' => $validated['receiver_address'],
                'declared_value' => $validated['amount'],
                'item_description' => $validated['item_description'] ?? 'Package',
                'notes' => $validated['notes'] ?? '',

                // Set default values for required fields
                'sender_email' => 'not-provided@example.com',
                'sender_phone' => 'Not Provided',
                'sender_address' => 'Not Provided',
                'sender_city' => 'Not Provided',
                'sender_state' => 'Not Provided',
                'sender_zip' => 'Not Provided',
                'sender_country' => 'Not Provided',
                'receiver_email' => 'not-provided@example.com',
                'receiver_city' => 'Not Provided',
                'receiver_state' => 'Not Provided',
                'receiver_zip' => 'Not Provided',
                'item_quantity' => 1,
                'total_weight' => 1.0,
                'number_of_boxes' => 1,
                'box_weight' => 1.0,
                'shipping_from' => $validated['shipping_from'],
                'shipping_to' => $validated['receiver_country'],
                'shipping_date' => now(),
                'estimated_delivery_date' => now()->addDays(7),

                // Tracking progress
                'current_step' => 1,
                'progress_percentage' => 25,
                'step1_name' => 'Package Registered',
                'step1_date' => now(),
            ]);

            return redirect()->route('register')
                ->with('success', 'Package registered successfully! Tracking Number: ' . $package->tracking_number);
        } catch (\Exception $e) {
            Log::error('Error registering package: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to register package. Please try again.')
                ->withInput();
        }
    }

    /**
     * Generate a new tracking number
     */
    public function generateTrackingNumber()
    {
        $trackingNumber = 'PKG' . Str::upper(Str::random(10));

        return response()->json([
            'tracking_number' => $trackingNumber
        ]);
    }
}
