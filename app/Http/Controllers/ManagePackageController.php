<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Mail\ShipmentCreated;
use Illuminate\Http\Request;
use App\Models\TrackingLocation;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ManagePackageController extends Controller
{
    protected $uploadApi;

    public function __construct()
    {
        $this->uploadApi = new UploadApi();
    }

    /**
     * Upload image to Cloudinary and return [url, public_id]
     */
    protected function uploadToCloudinary($file): array
    {
        $result = $this->uploadApi->upload(
            $file->getRealPath(),
            [
                'folder' => 'novexia/packages',
                'transformation' => [
                    'width' => 800,
                    'height' => 600,
                    'crop' => 'limit',
                    'quality' => 'auto',
                ]
            ]
        );

        return [
            'image_url' => $result['secure_url'],
            'image_public_id' => $result['public_id'],
        ];
    }

    /**
     * Upload video to Cloudinary and return [url, public_id]
     */
    protected function uploadVideoToCloudinary($file): array
    {
        $result = $this->uploadApi->upload(
            $file->getRealPath(),
            [
                'folder' => 'novexia/packages/videos',
                'resource_type' => 'video',
                'transformation' => [
                    'quality' => 'auto',
                ]
            ]
        );

        return [
            'video_url' => $result['secure_url'],
            'video_public_id' => $result['public_id'],
        ];
    }

    /**
     * Delete asset from Cloudinary by public_id
     */
    protected function deleteFromCloudinary(?string $publicId, string $resourceType = 'image'): void
    {
        if ($publicId) {
            try {
                $this->uploadApi->destroy($publicId, ['resource_type' => $resourceType]);
            } catch (\Exception $e) {
                Log::error('Failed to delete Cloudinary asset: ' . $e->getMessage());
            }
        }
    }

    public function index(Request $request)
    {
        try {
            $query = Package::with('trackingLocations')->latest();

            if ($request->search) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('tracking_number', 'LIKE', "%{$search}%")
                        ->orWhere('sender_name', 'LIKE', "%{$search}%")
                        ->orWhere('receiver_name', 'LIKE', "%{$search}%");
                });
            }

            $packages = $query->paginate(10)->withQueryString();

            return view('admin.package.index', compact('packages'));
        } catch (\Exception $e) {
            Log::error('Error fetching packages: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching packages.');
        }
    }

    public function showIndex()
    {
        try {
            $packages = Package::with('trackingLocations')
                ->latest()
                ->paginate(10);

            return view('admin.package.show.index', compact('packages'));
        } catch (\Exception $e) {
            Log::error('Error fetching packages: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching packages.');
        }
    }

    public function create()
    {
        try {
            return view('admin.package.create');
        } catch (\Exception $e) {
            Log::error('Error loading package create form: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the form.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'tracking_number' => 'required|string|unique:packages',
            'sender_email' => 'nullable|email',
            'receiver_email' => 'nullable|email',
            'declared_value' => 'nullable|numeric',
            'total_weight' => 'nullable|numeric',
            'estimated_delivery_date' => 'nullable|date',
            'media_type' => 'nullable|in:image,video',
            'package_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'package_video' => 'nullable|mimes:mp4,mov,avi,wmv,webm|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Auto-calculate progress percentage from current step
            $stepProgressMap = [1 => 25, 2 => 50, 3 => 75, 4 => 100];
            $currentStep = (int) $request->input('current_step', 1);
            $request->merge([
                'progress_percentage' => $stepProgressMap[$currentStep] ?? 25,
            ]);

            // Handle image upload to Cloudinary
            if ($request->hasFile('package_image')) {
                $imageData = $this->uploadToCloudinary($request->file('package_image'));
                $request->merge($imageData);
            }

            // Handle video upload to Cloudinary
            if ($request->hasFile('package_video')) {
                $videoData = $this->uploadVideoToCloudinary($request->file('package_video'));
                $request->merge($videoData);
            }

            $package = Package::create($request->except(['package_image', 'package_video', 'media_type', 'send_notification', 'remove_image', 'remove_video']));

            // Create initial tracking location
            TrackingLocation::create([
                'package_id' => $package->id,
                'location_name' => $request->shipping_from ?? 'Origin',
                'status' => 'Package received',
                'arrival_time' => now(),
                'is_current' => true,
            ]);

            // Send shipment notification email to receiver (if admin opted in)
            if ($request->has('send_notification') && $request->send_notification) {
                $package->load('trackingLocations');
                $recipientEmail = $package->receiver_email ?? $package->sender_email;
                if ($recipientEmail) {
                    try {
                        Mail::to($recipientEmail)->send(new ShipmentCreated($package));
                        Log::info('Shipment email sent', ['email' => $recipientEmail, 'tracking' => $package->tracking_number]);
                    } catch (\Exception $mailException) {
                        Log::error('Failed to send shipment email: ' . $mailException->getMessage(), [
                            'email' => $recipientEmail,
                            'package_id' => $package->id,
                        ]);
                    }
                }
            }

            Log::info('Package created successfully', ['package_id' => $package->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Package created successfully!',
                'redirect' => route('admin.packages.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating package: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error creating package: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Package $package)
    {
        try {
            $trackingLocations = $package->trackingLocations()
                ->orderBy('arrival_time', 'asc')
                ->get();

            return view('admin.package.edit', compact('package', 'trackingLocations'));
        } catch (\Exception $e) {
            Log::error('Error loading package edit form: ' . $e->getMessage(), ['package_id' => $package->id]);
            return back()->with('error', 'An error occurred while loading the edit form.');
        }
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        // Base validation rules
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'tracking_number' => 'required|string|unique:packages,tracking_number,' . $package->id,
            'sender_email' => 'nullable|email',
            'receiver_email' => 'nullable|email',
            'declared_value' => 'nullable|numeric',
            'total_weight' => 'nullable|numeric',
            'estimated_delivery_date' => 'nullable|date',
            'media_type' => 'nullable|in:image,video',
            'package_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'package_video' => 'nullable|mimes:mp4,mov,avi,wmv,webm|max:20480',

            // Add validation for tracking locations array
            'tracking_locations' => 'nullable|array',
            'tracking_locations.*.location_name' => 'required|string|max:255',
            'tracking_locations.*.status' => 'required|string|max:255',
            'tracking_locations.*.arrival_time' => 'required|date',
            'tracking_locations.*.is_current' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Auto-calculate progress percentage from current step
            $stepProgressMap = [1 => 25, 2 => 50, 3 => 75, 4 => 100];
            $currentStep = (int) $request->input('current_step', $package->current_step ?? 1);
            $request->merge([
                'progress_percentage' => $stepProgressMap[$currentStep] ?? 25,
            ]);

            // Update package details
            $updateData = $request->except(['tracking_locations', 'package_image', 'package_video', 'media_type', 'remove_image', 'remove_video', 'send_notification', '_method', '_token']);

            // Handle image removal
            if ($request->has('remove_image') && $request->remove_image) {
                $this->deleteFromCloudinary($package->image_public_id);
                $updateData['image_url'] = null;
                $updateData['image_public_id'] = null;
            }

            // Handle video removal
            if ($request->has('remove_video') && $request->remove_video) {
                $this->deleteFromCloudinary($package->video_public_id, 'video');
                $updateData['video_url'] = null;
                $updateData['video_public_id'] = null;
            }

            // Handle new image upload to Cloudinary
            if ($request->hasFile('package_image')) {
                // Delete old image if it exists
                $this->deleteFromCloudinary($package->image_public_id);
                $imageData = $this->uploadToCloudinary($request->file('package_image'));
                $updateData = array_merge($updateData, $imageData);
            }

            // Handle new video upload to Cloudinary
            if ($request->hasFile('package_video')) {
                // Delete old video if it exists
                $this->deleteFromCloudinary($package->video_public_id, 'video');
                $videoData = $this->uploadVideoToCloudinary($request->file('package_video'));
                $updateData = array_merge($updateData, $videoData);
            }

            $package->update($updateData);

            // Handle tracking locations
            if ($request->has('tracking_locations')) {
                $currentIds = [];

                foreach ($request->tracking_locations as $index => $locationData) {
                    // If this location has an ID, it's an existing one
                    if (isset($locationData['id'])) {
                        $location = TrackingLocation::where('id', $locationData['id'])
                            ->where('package_id', $package->id)
                            ->first();

                        if ($location) {
                            $location->update([
                                'location_name' => $locationData['location_name'],
                                'status' => $locationData['status'],
                                'arrival_time' => $locationData['arrival_time'],
                                'is_current' => $locationData['is_current'] ?? false,
                            ]);
                            $currentIds[] = $location->id;
                        }
                    } else {
                        // Create new location
                        $location = $package->trackingLocations()->create([
                            'location_name' => $locationData['location_name'],
                            'status' => $locationData['status'],
                            'arrival_time' => $locationData['arrival_time'],
                            'is_current' => $locationData['is_current'] ?? false,
                        ]);
                        $currentIds[] = $location->id;
                    }
                }

                // Delete any locations that weren't included in the update
                $package->trackingLocations()
                    ->whereNotIn('id', $currentIds)
                    ->delete();
            }

            DB::commit();

            // Send shipment update notification email (if admin opted in)
            if ($request->has('send_notification') && $request->send_notification) {
                $package->load('trackingLocations');
                $recipientEmail = $package->receiver_email ?? $package->sender_email;
                if ($recipientEmail) {
                    try {
                        Mail::to($recipientEmail)->send(new ShipmentCreated($package));
                        Log::info('Shipment update email sent', ['email' => $recipientEmail, 'tracking' => $package->tracking_number]);
                    } catch (\Exception $mailException) {
                        Log::error('Failed to send shipment update email: ' . $mailException->getMessage(), [
                            'email' => $recipientEmail,
                            'package_id' => $package->id,
                        ]);
                    }
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Package updated successfully!',
                'redirect' => route('admin.packages.edit', $package->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating package: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error updating package: ' . $e->getMessage()
            ], 500);
        }
    }


    public function show(Package $package)
    {
        try {
            $trackingLocations = $package->trackingLocations()
                ->orderBy('arrival_time', 'asc')
                ->get();

            return view('admin.packages.show', compact('package', 'trackingLocations'));
        } catch (\Exception $e) {
            Log::error('Error showing package: ' . $e->getMessage(), ['package_id' => $package->id]);
            return back()->with('error', 'An error occurred while loading the package details.');
        }
    }

    public function sendEmailIndex(Request $request)
    {
        try {
            $query = Package::latest();

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('tracking_number', 'LIKE', "%{$search}%")
                        ->orWhere('sender_name', 'LIKE', "%{$search}%")
                        ->orWhere('receiver_name', 'LIKE', "%{$search}%")
                        ->orWhere('receiver_email', 'LIKE', "%{$search}%");
                });
            }

            $packages = $query->paginate(10)->withQueryString();

            return view('admin.package.send-email', compact('packages'));
        } catch (\Exception $e) {
            Log::error('Error loading send email page: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the page.');
        }
    }

    public function sendEmail(Package $package)
    {
        try {
            $package->load('trackingLocations');
            $recipientEmail = $package->receiver_email ?? $package->sender_email;

            if (!$recipientEmail) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No recipient email address found for this package.'
                ], 422);
            }

            Mail::to($recipientEmail)->send(new ShipmentCreated($package));

            Log::info('Shipment email sent manually by admin', [
                'email' => $recipientEmail,
                'tracking' => $package->tracking_number
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully to ' . $recipientEmail
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send shipment email: ' . $e->getMessage(), [
                'package_id' => $package->id
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Package $package)
    {
        try {
            // Delete image from Cloudinary
            $this->deleteFromCloudinary($package->image_public_id);
            // Delete video from Cloudinary
            $this->deleteFromCloudinary($package->video_public_id, 'video');

            $package->trackingLocations()->delete();
            $package->delete();

            Log::info('Package deleted successfully', ['package_id' => $package->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Package deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting package: ' . $e->getMessage(), [
                'exception' => $e,
                'package_id' => $package->id
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting package: ' . $e->getMessage()
            ], 500);
        }
    }
}
