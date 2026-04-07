<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Mail\CustomEmail;
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
            'package_images' => 'nullable|array|max:10',
            'package_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'package_videos' => 'nullable|array|max:5',
            'package_videos.*' => 'mimes:mp4,mov,avi,wmv,webm|max:20480',
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

            // Handle multiple image uploads to Cloudinary
            $imageUrls = [];
            $imagePublicIds = [];
            if ($request->hasFile('package_images')) {
                foreach ($request->file('package_images') as $imageFile) {
                    $imageData = $this->uploadToCloudinary($imageFile);
                    $imageUrls[] = $imageData['image_url'];
                    $imagePublicIds[] = $imageData['image_public_id'];
                }
            }
            $request->merge([
                'image_url' => $imageUrls,
                'image_public_id' => $imagePublicIds,
            ]);

            // Handle multiple video uploads to Cloudinary
            $videoUrls = [];
            $videoPublicIds = [];
            if ($request->hasFile('package_videos')) {
                foreach ($request->file('package_videos') as $videoFile) {
                    $videoData = $this->uploadVideoToCloudinary($videoFile);
                    $videoUrls[] = $videoData['video_url'];
                    $videoPublicIds[] = $videoData['video_public_id'];
                }
            }
            $request->merge([
                'video_url' => $videoUrls,
                'video_public_id' => $videoPublicIds,
            ]);

            $package = Package::create($request->except(['package_images', 'package_videos', 'media_type', 'send_notification', 'remove_image', 'remove_video']));

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
            'package_images' => 'nullable|array|max:10',
            'package_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'package_videos' => 'nullable|array|max:5',
            'package_videos.*' => 'mimes:mp4,mov,avi,wmv,webm|max:20480',

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
            $updateData = $request->except(['tracking_locations', 'package_images', 'package_videos', 'media_type', 'remove_images', 'remove_videos', 'send_notification', '_method', '_token']);

            // Current arrays
            $currentImageUrls = $package->image_url ?? [];
            $currentImagePublicIds = $package->image_public_id ?? [];
            $currentVideoUrls = $package->video_url ?? [];
            $currentVideoPublicIds = $package->video_public_id ?? [];

            // Handle individual image removals
            if ($request->has('remove_images')) {
                $removeIndices = array_map('intval', $request->remove_images);
                foreach ($removeIndices as $idx) {
                    if (isset($currentImagePublicIds[$idx])) {
                        $this->deleteFromCloudinary($currentImagePublicIds[$idx]);
                    }
                }
                // Remove the specified indices
                $currentImageUrls = array_values(array_diff_key($currentImageUrls, array_flip($removeIndices)));
                $currentImagePublicIds = array_values(array_diff_key($currentImagePublicIds, array_flip($removeIndices)));
            }

            // Handle individual video removals
            if ($request->has('remove_videos')) {
                $removeIndices = array_map('intval', $request->remove_videos);
                foreach ($removeIndices as $idx) {
                    if (isset($currentVideoPublicIds[$idx])) {
                        $this->deleteFromCloudinary($currentVideoPublicIds[$idx], 'video');
                    }
                }
                $currentVideoUrls = array_values(array_diff_key($currentVideoUrls, array_flip($removeIndices)));
                $currentVideoPublicIds = array_values(array_diff_key($currentVideoPublicIds, array_flip($removeIndices)));
            }

            // Handle new image uploads (append to existing)
            if ($request->hasFile('package_images')) {
                foreach ($request->file('package_images') as $imageFile) {
                    $imageData = $this->uploadToCloudinary($imageFile);
                    $currentImageUrls[] = $imageData['image_url'];
                    $currentImagePublicIds[] = $imageData['image_public_id'];
                }
            }

            // Handle new video uploads (append to existing)
            if ($request->hasFile('package_videos')) {
                foreach ($request->file('package_videos') as $videoFile) {
                    $videoData = $this->uploadVideoToCloudinary($videoFile);
                    $currentVideoUrls[] = $videoData['video_url'];
                    $currentVideoPublicIds[] = $videoData['video_public_id'];
                }
            }

            $updateData['image_url'] = $currentImageUrls;
            $updateData['image_public_id'] = $currentImagePublicIds;
            $updateData['video_url'] = $currentVideoUrls;
            $updateData['video_public_id'] = $currentVideoPublicIds;

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
            // Delete all images from Cloudinary
            foreach (($package->image_public_id ?? []) as $publicId) {
                $this->deleteFromCloudinary($publicId);
            }
            // Delete all videos from Cloudinary
            foreach (($package->video_public_id ?? []) as $publicId) {
                $this->deleteFromCloudinary($publicId, 'video');
            }

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

    public function composeEmail()
    {
        return view('admin.package.compose-email');
    }

    public function sendCustomEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Mail::to($request->recipient_email)->send(
                new CustomEmail($request->subject, $request->message)
            );

            Log::info('Custom email sent by admin', [
                'to' => $request->recipient_email,
                'subject' => $request->subject
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully to ' . $request->recipient_email
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send custom email: ' . $e->getMessage(), [
                'to' => $request->recipient_email
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }
}
