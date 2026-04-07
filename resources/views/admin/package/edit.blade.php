@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Update Package</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="updatePackageForm" method="POST"
                                action="{{ route('admin.packages.update', $package->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Progress Steps Indicator -->
                                <div class="steps-progress mb-5">
                                    <div class="steps">
                                        <div class="step active" data-step="1" onclick="jumpToStep(1)">
                                            <div class="step-number">1</div>
                                            <div class="step-title">Sender/Receiver</div>
                                        </div>
                                        <div class="step" data-step="2" onclick="jumpToStep(2)">
                                            <div class="step-number">2</div>
                                            <div class="step-title">Package Details</div>
                                        </div>
                                        <div class="step" data-step="3" onclick="jumpToStep(3)">
                                            <div class="step-number">3</div>
                                            <div class="step-title">Shipping</div>
                                        </div>
                                        <div class="step" data-step="4" onclick="jumpToStep(4)">
                                            <div class="step-number">4</div>
                                            <div class="step-title">Tracking</div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%"></div>
                                    </div>
                                </div>

                                <!-- Step 1: Sender & Receiver Information -->
                                <div class="form-step step-1 animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 1: Sender & Receiver Information</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-header bg-primary text-white">
                                                    <h5>Sender Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="sender_name" class="form-control"
                                                            value="{{ old('sender_name', $package->sender_name) }}"
                                                            required>
                                                        <span class="text-danger" id="sender_name_error"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="sender_address" class="form-control"
                                                            value="{{ old('sender_address', $package->sender_address) }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" name="sender_city"
                                                                    class="form-control"
                                                                    value="{{ old('sender_city', $package->sender_city) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>State/Province</label>
                                                                <input type="text" name="sender_state"
                                                                    class="form-control"
                                                                    value="{{ old('sender_state', $package->sender_state) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ZIP/Postal Code</label>
                                                                <input type="text" name="sender_zip"
                                                                    class="form-control"
                                                                    value="{{ old('sender_zip', $package->sender_zip) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input type="text" name="sender_country"
                                                                    class="form-control"
                                                                    value="{{ old('sender_country', $package->sender_country) }}"
                                                                    placeholder="Enter Country">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" name="sender_phone"
                                                                    class="form-control"
                                                                    value="{{ old('sender_phone', $package->sender_phone) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="sender_email"
                                                                    class="form-control"
                                                                    value="{{ old('sender_email', $package->sender_email) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-header bg-primary text-white">
                                                    <h5>Receiver Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="receiver_name" class="form-control"
                                                            value="{{ old('receiver_name', $package->receiver_name) }}"
                                                            required>
                                                        <span class="text-danger" id="receiver_name_error"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="receiver_address" class="form-control"
                                                            value="{{ old('receiver_address', $package->receiver_address) }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" name="receiver_city"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_city', $package->receiver_city) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>State/Province</label>
                                                                <input type="text" name="receiver_state"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_state', $package->receiver_state) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ZIP/Postal Code</label>
                                                                <input type="text" name="receiver_zip"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_zip', $package->receiver_zip) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input type="text" name="receiver_country"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_country', $package->receiver_country) }}"
                                                                    placeholder="Enter Country">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" name="receiver_phone"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_phone', $package->receiver_phone) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="receiver_email"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_email', $package->receiver_email) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-primary next-step">
                                            Next <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 2: Package Details -->
                                <div class="form-step step-2 d-none animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 2: Package Details</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tracking Number <span class="text-danger">*</span></label>
                                                <input type="text" name="tracking_number" class="form-control"
                                                    value="{{ old('tracking_number', $package->tracking_number) }}"
                                                    required>
                                                <span class="text-danger" id="tracking_number_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Item Description</label>
                                                <textarea name="item_description" class="form-control"
                                                    rows="3">{{ old('item_description', $package->item_description) }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Item Quantity</label>
                                                <input type="number" name="item_quantity" class="form-control"
                                                    value="{{ old('item_quantity', $package->item_quantity) }}">
                                                <div class="input-hint">Please enter only numbers (e.g. 5)</div>
                                                <div class="input-example">Example: 5 (for 5 items)</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Declared Value</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" step="any" name="declared_value"
                                                        class="form-control"
                                                        value="{{ old('declared_value', $package->declared_value) }}">
                                                    <div class="input-hint">Please enter only numbers (e.g. 99.99)</div>
                                                    <div class="input-example">Example: 99.99 (for $99.99)</div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Weight (kg)</label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="total_weight"
                                                        class="form-control"
                                                        value="{{ old('total_weight', $package->total_weight) }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                    <div class="input-hint">Please enter only numbers (e.g. 2.5)</div>
                                                    <div class="input-example">Example: 2.5 (for 2.5 kilograms)</div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Number of Boxes</label>
                                                <input type="number" name="number_of_boxes" class="form-control"
                                                    value="{{ old('number_of_boxes', $package->number_of_boxes) }}">
                                                <div class="input-hint">Please enter only whole numbers (e.g. 3)</div>
                                                <div class="input-example">Example: 3 (for 3 boxes)</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Box Weight (kg)</label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="box_weight"
                                                        class="form-control"
                                                        value="{{ old('box_weight', $package->box_weight) }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                    <div class="input-hint">Please enter only numbers (e.g. 0.5)</div>
                                                    <div class="input-example">Example: 0.5 (for 500 grams)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Package Media Upload (Multiple Images and/or Videos) -->
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><i class="fas fa-camera mr-1"></i> Package Images <span
                                                        class="text-muted">(Optional, up to 10)</span></label>

                                                <!-- Existing Images -->
                                                <div id="imageUploadSection">
                                                    @if(!empty($package->image_url) && count($package->image_url) > 0)
                                                    <div id="currentImagesContainer" class="mb-3">
                                                        <p class="text-muted small mb-2">Current images (check to
                                                            remove):</p>
                                                        <div class="d-flex flex-wrap" style="gap: 10px;">
                                                            @foreach($package->image_url as $index => $imageUrl)
                                                            <div class="position-relative d-inline-block existing-image-item"
                                                                data-index="{{ $index }}">
                                                                <img src="{{ $imageUrl }}"
                                                                    alt="Package image {{ $index + 1 }}"
                                                                    class="rounded shadow-sm"
                                                                    style="width: 120px; height: 90px; object-fit: cover;">
                                                                <span class="badge badge-info position-absolute"
                                                                    style="top: -8px; left: -8px; font-size: 10px;">{{
                                                                    $index + 1 }}</span>
                                                                <div class="mt-1 text-center">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input remove-image-check"
                                                                            id="removeImage{{ $index }}"
                                                                            name="remove_images[]" value="{{ $index }}">
                                                                        <label
                                                                            class="custom-control-label text-danger small"
                                                                            for="removeImage{{ $index }}">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="packageImages"
                                                            name="package_images[]" multiple
                                                            accept="image/jpeg,image/png,image/jpg,image/gif">
                                                        <label class="custom-file-label" for="packageImages">Add more
                                                            images...</label>
                                                    </div>
                                                    <small class="text-muted">Max 2MB each. Formats: JPEG, PNG, JPG,
                                                        GIF. New images will be added to existing ones.</small>
                                                    <div id="imagePreviewContainer" class="mt-3 d-none">
                                                        <p class="text-muted small mb-2">New images to add:</p>
                                                        <div class="d-flex flex-wrap" id="imagePreviews"
                                                            style="gap: 10px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><i class="fas fa-video mr-1"></i> Package Videos <span
                                                        class="text-muted">(Optional, up to 5)</span></label>

                                                <!-- Existing Videos -->
                                                <div id="videoUploadSection">
                                                    @if(!empty($package->video_url) && count($package->video_url) > 0)
                                                    <div id="currentVideosContainer" class="mb-3">
                                                        <p class="text-muted small mb-2">Current videos (check to
                                                            remove):</p>
                                                        <div class="d-flex flex-wrap" style="gap: 10px;">
                                                            @foreach($package->video_url as $index => $videoUrl)
                                                            <div class="position-relative d-inline-block existing-video-item"
                                                                data-index="{{ $index }}">
                                                                <video controls class="rounded shadow-sm"
                                                                    style="width: 200px; height: 140px;">
                                                                    <source src="{{ $videoUrl }}" type="video/mp4">
                                                                </video>
                                                                <span class="badge badge-info position-absolute"
                                                                    style="top: -8px; left: -8px; font-size: 10px;">{{
                                                                    $index + 1 }}</span>
                                                                <div class="mt-1 text-center">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input remove-video-check"
                                                                            id="removeVideo{{ $index }}"
                                                                            name="remove_videos[]" value="{{ $index }}">
                                                                        <label
                                                                            class="custom-control-label text-danger small"
                                                                            for="removeVideo{{ $index }}">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="packageVideos"
                                                            name="package_videos[]" multiple
                                                            accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/webm">
                                                        <label class="custom-file-label" for="packageVideos">Add more
                                                            videos...</label>
                                                    </div>
                                                    <small class="text-muted">Max 20MB each. Formats: MP4, MOV, AVI,
                                                        WMV, WEBM. New videos will be added to existing ones.</small>
                                                    <div id="videoPreviewContainer" class="mt-3 d-none">
                                                        <p class="text-muted small mb-2">New videos to add:</p>
                                                        <div class="d-flex flex-wrap" id="videoPreviews"
                                                            style="gap: 10px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-secondary prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step">
                                            Next <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 3: Shipping Details -->
                                <div class="form-step step-3 d-none animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 3: Shipping Details</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shipping From</label>
                                                <input type="text" name="shipping_from" class="form-control"
                                                    value="{{ old('shipping_from', $package->shipping_from) }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Shipping Date</label>
                                                <input type="datetime-local" name="shipping_date" class="form-control"
                                                    value="{{ old('shipping_date', $package->shipping_date ? \Carbon\Carbon::parse($package->shipping_date)->format('Y-m-d\TH:i') : '') }}">
                                                <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shipping To</label>
                                                <input type="text" name="shipping_to" class="form-control"
                                                    value="{{ old('shipping_to', $package->shipping_to) }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Delivery Date</label>
                                                <input type="datetime-local" name="estimated_delivery_date"
                                                    class="form-control"
                                                    value="{{ old('estimated_delivery_date', $package->estimated_delivery_date ? \Carbon\Carbon::parse($package->estimated_delivery_date)->format('Y-m-d\TH:i') : '') }}">
                                                <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-secondary prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step">
                                            Next <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 4: Progress Tracking -->
                                <div class="form-step step-4 d-none animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 4: Progress Tracking</h3>

                                    {{-- Admin Guide --}}
                                    <div class="alert alert-info border-0 shadow-sm mb-4"
                                        style="background: linear-gradient(135deg, #e0f2fe, #f0f9ff); border-left: 4px solid #0ea5e9 !important;">
                                        <h5 class="mb-3"><i class="fas fa-info-circle text-info mr-2"></i> How to Set Up
                                            This Step</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-2"><strong><i class="fas fa-shoe-prints mr-1"></i> Current
                                                        Step</strong></p>
                                                <p class="text-muted small mb-2">Update this to move the customer's
                                                    progress bar forward.</p>
                                                <ul class="small text-muted pl-3 mb-3">
                                                    <li><strong>Step 1 – Initiation:</strong> Package just created /
                                                        received at warehouse</li>
                                                    <li><strong>Step 2 – Verification:</strong> Package details
                                                        verified, customs cleared</li>
                                                    <li><strong>Step 3 – Processing:</strong> Package in transit / being
                                                        shipped</li>
                                                    <li><strong>Step 4 – Completion:</strong> Package delivered to
                                                        receiver</li>
                                                </ul>

                                                <p class="mb-2"><strong><i class="fas fa-percentage mr-1"></i> Progress
                                                        Percentage</strong></p>
                                                <p class="text-muted small mb-0">Auto-calculated from Current Step (25%,
                                                    50%, 75%, 100%). You can override if you need a custom value like
                                                    <code>60%</code>.
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-2"><strong><i class="fas fa-tags mr-1"></i> Step Names &
                                                        Dates</strong></p>
                                                <p class="text-muted small mb-2">Customize labels shown on the tracking
                                                    page. Leave blank to use defaults.<br>
                                                    <strong>Example:</strong>
                                                </p>
                                                <table class="table table-sm table-bordered small mb-3"
                                                    style="background: white;">
                                                    <tr>
                                                        <td>Step 1 Name</td>
                                                        <td><code>Picked Up</code></td>
                                                        <td>Mar 15, 9:00 AM</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Step 2 Name</td>
                                                        <td><code>Customs Cleared</code></td>
                                                        <td>Mar 17, 2:30 PM</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Step 3 Name</td>
                                                        <td><code>In Transit to UK</code></td>
                                                        <td>Mar 18, 6:00 AM</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Step 4 Name</td>
                                                        <td><code>Delivered</code></td>
                                                        <td><em>(leave empty until done)</em></td>
                                                    </tr>
                                                </table>

                                                <p class="mb-2"><strong><i class="fas fa-map-marker-alt mr-1"></i>
                                                        Tracking Locations</strong></p>
                                                <p class="text-muted small mb-2">Add each stop the package goes through.
                                                    Toggle <strong>"Current"</strong> ON <em>only</em> for the location
                                                    where the package is <em>right now</em>. Turn off "Current" on old
                                                    locations. Click <strong>"+ Add Location"</strong> to add new stops.
                                                </p>

                                                <p class="mb-2"><strong><i class="fas fa-envelope mr-1"></i> Email
                                                        Notification</strong></p>
                                                <p class="text-muted small mb-0">Toggle ON at the bottom if you want the
                                                    customer to receive an email about this update. It's OFF by default
                                                    on edits so you don't spam them with every small change.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Step</label>
                                                <select name="current_step" class="form-control">
                                                    <option value="1" {{ old('current_step', $package->current_step)==1
                                                        ? 'selected' : '' }}>
                                                        Step 1: Initiation</option>
                                                    <option value="2" {{ old('current_step', $package->current_step)==2
                                                        ? 'selected' : '' }}>
                                                        Step 2: Verification</option>
                                                    <option value="3" {{ old('current_step', $package->current_step)==3
                                                        ? 'selected' : '' }}>
                                                        Step 3: Processing</option>
                                                    <option value="4" {{ old('current_step', $package->current_step)==4
                                                        ? 'selected' : '' }}>
                                                        Step 4: Completion</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Progress Percentage</label>
                                                <div class="input-group">
                                                    <input type="number" min="0" max="100" name="progress_percentage"
                                                        class="form-control"
                                                        value="{{ old('progress_percentage', $package->progress_percentage) }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="input-hint">Enter a value between 0 and 100</div>
                                                <div class="input-example">Example: 75 (for 75% complete)</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Notes</label>
                                                <textarea name="notes" class="form-control"
                                                    rows="3">{{ old('notes', $package->notes) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        @for($i = 1; $i <= 4; $i++) <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Step {{ $i }} Name</label>
                                                <input type="text" name="step{{ $i }}_name" class="form-control"
                                                    value="{{ old('step'.$i.'_name', $package->{'step'.$i.'_name'}) }}">
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Step {{ $i }} Date</label>
                                            <input type="datetime-local" name="step{{ $i }}_date" class="form-control"
                                                value="value=" {{ old('step'.$i.'_date',
                                                optional($package->{'step'.$i.'_date'})->format('Y-m-d\TH:i')) }}"
                                            ">
                                            <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>

                                <!-- Tracking Locations -->
                                <div class="card mt-4 shadow-sm">
                                    <div
                                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Tracking Locations</h5>
                                        <button type="button" class="btn btn-sm btn-light" id="addTrackingLocation">
                                            <i class="fas fa-plus"></i> Add Location
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="trackingLocations">
                                            @foreach($package->trackingLocations as $index => $location)
                                            <div class="tracking-location mb-3 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Location Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text"
                                                                name="tracking_locations[{{ $index }}][location_name]"
                                                                class="form-control" required value="{{ old("
                                                                tracking_locations.$index.location_name",
                                                                $location->location_name) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Status <span class="text-danger">*</span></label>
                                                            <select name="tracking_locations[{{ $index }}][status]"
                                                                class="form-control" required>
                                                                <option value="Package received" {{
                                                                    old("tracking_locations.$index.status", $location->
                                                                    status) == 'Package received' ? 'selected' : ''
                                                                    }}>Package received</option>
                                                                <option value="In transit" {{
                                                                    old("tracking_locations.$index.status", $location->
                                                                    status) == 'In transit' ? 'selected' : '' }}>In
                                                                    transit</option>
                                                                <option value="Out for delivery" {{
                                                                    old("tracking_locations.$index.status", $location->
                                                                    status) == 'Out for delivery' ? 'selected' : ''
                                                                    }}>Out for delivery</option>
                                                                <option value="Delivered" {{
                                                                    old("tracking_locations.$index.status", $location->
                                                                    status) == 'Delivered' ? 'selected' : ''
                                                                    }}>Delivered</option>
                                                                <option value="Exception" {{
                                                                    old("tracking_locations.$index.status", $location->
                                                                    status) == 'Exception' ? 'selected' : ''
                                                                    }}>Exception</option>
                                                                <option value="On Hold" {{
                                                                    old("tracking_locations.$index.status", $location->
                                                                    status) == 'On Hold' ? 'selected' : ''
                                                                    }}>On Hold</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Arrival Time <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="datetime-local"
                                                                name="tracking_locations[{{ $index }}][arrival_time]"
                                                                class="form-control" required value="{{ old("
                                                                tracking_locations.$index.arrival_time",
                                                                $location->arrival_time ?
                                                            $location->arrival_time->format('Y-m-d\TH:i') : '') }}">
                                                            <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Current</label>
                                                            <div class="custom-control custom-switch mt-2">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="is_current_{{ $index }}"
                                                                    name="tracking_locations[{{ $index }}][is_current]"
                                                                    value="1" {{
                                                                    old("tracking_locations.$index.is_current",
                                                                    $location->is_current) ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="is_current_{{ $index }}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger remove-location">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Email Notification Toggle --}}
                                <div class="card border-0 shadow-sm mt-4 mb-3"
                                    style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-left: 4px solid #0ea5e9 !important;">
                                    <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fas fa-envelope text-info mr-2"></i>
                                            <strong class="text-dark">Send Email Notification</strong>
                                            <p class="mb-0 text-muted small">Notify the receiver about this shipment
                                                update via email</p>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="sendNotification"
                                                name="send_notification" value="1">
                                            <label class="custom-control-label" for="sendNotification"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mt-4">
                                    <button type="button" class="btn btn-secondary prev-step">
                                        <i class="fas fa-arrow-left mr-2"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success" id="submitBtn">
                                        <span id="submitText">Update Package</span>
                                        <span id="submitSpinner" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                        </div>
                        </form>

                        <!-- Upload Progress Modal -->
                        <div class="modal fade" id="uploadProgressModal" tabindex="-1" role="dialog"
                            data-backdrop="static" data-keyboard="false" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 420px;">
                                <div class="modal-content"
                                    style="border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                                    <div class="modal-body text-center" style="padding: 45px 35px 40px;">
                                        <div id="uploadIconWrap" style="margin-bottom: 15px;">
                                            <div
                                                style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #e8f0fe, #d2e3fc); display: inline-flex; align-items: center; justify-content: center;">
                                                <i id="uploadIcon" class="fas fa-cloud-upload-alt"
                                                    style="font-size: 32px; color: #1572E8; animation: uploadPulse 2s ease-in-out infinite;"></i>
                                            </div>
                                        </div>
                                        <div id="uploadPercentNumber"
                                            style="font-size: 54px; font-weight: 800; background: linear-gradient(135deg, #1572E8, #49a3ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.1; margin-bottom: 4px; font-family: 'Segoe UI', system-ui, sans-serif;">
                                            0%</div>
                                        <p id="uploadProgressText"
                                            style="font-size: 15px; color: #6c757d; margin-bottom: 24px; font-weight: 500;">
                                            Uploading your files...</p>
                                        <div
                                            style="position: relative; height: 8px; border-radius: 4px; background: #e9ecef; overflow: hidden;">
                                            <div id="uploadProgressBar" role="progressbar"
                                                style="width: 0%; height: 100%; border-radius: 4px; transition: width 0.3s ease; background: linear-gradient(90deg, #1572E8, #49a3ff);"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-3 mb-0" style="font-size: 12px; color: #adb5bd;"><i
                                                class="fas fa-lock mr-1"></i> Please do not close or refresh this page
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .steps-progress {
        position: relative;
        margin-bottom: 30px;
    }

    .steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .step {
        text-align: center;
        flex: 1;
        position: relative;
        cursor: pointer;
    }

    .step:hover .step-number {
        background-color: #007bff;
        color: white;
        opacity: 0.8;
    }

    .step:hover .step-title {
        color: #007bff;
        font-weight: bold;
    }

    .step-number {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        margin: 0 auto 10px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .step-title {
        color: #6c757d;
        font-size: 14px;
        transition: all 0.3s;
    }

    .step.active .step-number {
        background-color: #007bff;
        color: white;
    }

    .step.active .step-title {
        color: #007bff;
        font-weight: bold;
    }

    .progress {
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }

    .progress-bar {
        background-color: #007bff;
        transition: width 0.3s;
    }

    .tracking-location {
        background-color: #f8f9fa;
        position: relative;
    }

    .remove-location {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .animated {
        animation-duration: 0.5s;
    }

    /* Input hints and examples */
    .input-hint {
        font-size: 12px;
        color: #dc3545;
        margin-top: 2px;
        display: none;
    }

    .input-example {
        font-size: 12px;
        color: #6c757d;
        font-style: italic;
        margin-top: 2px;
    }

    .is-invalid~.input-hint {
        display: block;
    }

    /* Better error highlighting */
    .is-invalid {
        border-color: #dc3545;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, .25);
    }

    /* Upload progress modal animations */
    @keyframes uploadPulse {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-4px);
        }
    }

    @keyframes uploadSpin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #uploadProgressModal .modal-content {
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

@include('admin.footer')

<script>
    function jumpToStep(stepNumber) {
        if ($(`.form-step.step-${stepNumber}`).hasClass('active')) return;
        
        $('.form-step').removeClass('active fadeIn').addClass('d-none');
        $(`.form-step.step-${stepNumber}`).removeClass('d-none').addClass('active fadeIn');
        updateProgressSteps(stepNumber);
        $('html, body').animate({ scrollTop: $('.page-inner').offset().top }, 300);
    }

    function updateProgressSteps(activeStep) {
        $('.step').removeClass('active');
        $(`.step[data-step="${activeStep}"]`).addClass('active');
        
        const progressPercentage = ((activeStep - 1) / 3) * 100;
        $('.steps-progress .progress-bar').css('width', progressPercentage + '%');
        
        if (activeStep === 4) {
            $('.next-step').addClass('d-none');
        } else {
            $('.next-step').removeClass('d-none');
        }
        $('.prev-step').toggle(activeStep > 1);
    }

    function validateStep(stepNumber) {
        let isValid = true;
        
        $('.text-danger').text('');
        $('.is-invalid').removeClass('is-invalid');
        $('.input-hint').hide();
        
        if (stepNumber === 1) {
            if (!$('input[name="sender_name"]').val().trim()) {
                $('#sender_name_error').text('Sender name is required');
                $('input[name="sender_name"]').addClass('is-invalid');
                isValid = false;
            }
            if (!$('input[name="receiver_name"]').val().trim()) {
                $('#receiver_name_error').text('Receiver name is required');
                $('input[name="receiver_name"]').addClass('is-invalid');
                isValid = false;
            }
        }
        
        if (stepNumber === 2) {
            if (!$('input[name="tracking_number"]').val().trim()) {
                $('#tracking_number_error').text('Tracking number is required');
                $('input[name="tracking_number"]').addClass('is-invalid');
                isValid = false;
            }
            const numericFields = ['item_quantity', 'total_weight', 'box_weight', 'declared_value', 'number_of_boxes'];
            numericFields.forEach(field => {
                const value = $(`input[name="${field}"]`).val();
                if (value && isNaN(value)) {
                    $(`input[name="${field}"]`).addClass('is-invalid');
                    $(`input[name="${field}"]`).siblings('.input-hint').show();
                    isValid = false;
                }
            });
        }
        
        if (!isValid) {
            const firstErr = $('.is-invalid:first');
            if (firstErr.length) {
                $('html, body').animate({ scrollTop: firstErr.offset().top - 100 }, 300);
            }
            toastr.error('Please correct the highlighted fields');
        }
        
        return isValid;
    }

    $(document).ready(function() {
        toastr.options = {
            "closeButton": true, "progressBar": true, "positionClass": "toast-top-right",
            "showDuration": "300", "hideDuration": "1000", "timeOut": "5000",
            "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"
        };

        updateProgressSteps(1);
        $('.step-1').addClass('active');

        // Step navigation
        $('.next-step').on('click', function() {
            const currentStep = $(this).closest('.form-step');
            const currentStepNumber = parseInt(currentStep.attr('class').match(/step-(\d+)/)[1]);
            if (!validateStep(currentStepNumber)) return;

            currentStep.removeClass('active fadeIn').addClass('d-none');
            currentStep.next('.form-step').removeClass('d-none').addClass('active fadeIn');
            updateProgressSteps(currentStepNumber + 1);
            $('html, body').animate({ scrollTop: $('.page-inner').offset().top }, 300);
        });

        $('.prev-step').on('click', function() {
            const currentStep = $(this).closest('.form-step');
            const currentStepNumber = parseInt(currentStep.attr('class').match(/step-(\d+)/)[1]);

            currentStep.removeClass('active fadeIn').addClass('d-none');
            currentStep.prev('.form-step').removeClass('d-none').addClass('active fadeIn');
            updateProgressSteps(currentStepNumber - 1);
            $('html, body').animate({ scrollTop: $('.page-inner').offset().top }, 300);
        });

        // Numeric field validation
        $('input[name="item_quantity"], input[name="total_weight"], input[name="box_weight"], input[name="declared_value"], input[name="number_of_boxes"]').on('input', function() {
            const value = $(this).val();
            if (value && isNaN(value)) {
                $(this).addClass('is-invalid');
                $(this).siblings('.input-hint').show();
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.input-hint').hide();
            }
        });

        // Tracking locations
        let locationCounter = {{ $package->trackingLocations->count() }};
        $('#addTrackingLocation').on('click', function() {
            const newLocation = `
                <div class="tracking-location mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Location Name <span class="text-danger">*</span></label>
                                <input type="text" name="tracking_locations[${locationCounter}][location_name]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="tracking_locations[${locationCounter}][status]" class="form-control" required>
                                    <option value="Package received">Package received</option>
                                    <option value="In transit" selected>In transit</option>
                                    <option value="Out for delivery">Out for delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Exception">Exception</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Arrival Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="tracking_locations[${locationCounter}][arrival_time]" class="form-control" required>
                                <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Current</label>
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" id="is_current_${locationCounter}" name="tracking_locations[${locationCounter}][is_current]" value="1">
                                    <label class="custom-control-label" for="is_current_${locationCounter}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-location"><i class="fas fa-trash"></i> Remove</button>
                </div>`;
            $('#trackingLocations').append(newLocation);
            $('input[name^="tracking_locations"][name$="[arrival_time]"]:last').val(new Date().toISOString().slice(0, 16));
            locationCounter++;
        });

        $(document).on('click', '.remove-location', function() {
            if ($('.tracking-location').length > 1) {
                $(this).closest('.tracking-location').remove();
            } else {
                toastr.error('You must have at least one tracking location');
            }
        });

        // Form submission with upload progress
        $('#updatePackageForm').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const submitBtn = $('#submitBtn');
            const submitText = $('#submitText');
            const submitSpinner = $('#submitSpinner');

            // Clear previous errors
            $('.text-danger').text('');
            $('.is-invalid').removeClass('is-invalid');
            $('.input-hint').hide();

            const formData = new FormData(this);
            const hasFile = $('#packageImages')[0] && $('#packageImages')[0].files.length > 0;
            const hasVideo = $('#packageVideos')[0] && $('#packageVideos')[0].files.length > 0;
            const hasMedia = hasFile || hasVideo;

            // Show upload progress modal if uploading media
            let serverTimer = null;
            let currentDisplayPercent = 0;

            function updateProgressUI(percent, text) {
                currentDisplayPercent = percent;
                $('#uploadPercentNumber').text(Math.round(percent) + '%');
                $('#uploadProgressBar').css('width', percent + '%').attr('aria-valuenow', Math.round(percent));
                if (text) $('#uploadProgressText').text(text);
            }

            if (hasMedia) {
                updateProgressUI(0, 'Uploading your files...');
                $('#uploadIcon').attr('class', 'fas fa-cloud-upload-alt').css('animation', 'uploadPulse 2s ease-in-out infinite');
                $('#uploadProgressModal').modal('show');
            }

            submitText.text('Updating...');
            submitSpinner.removeClass('d-none');
            submitBtn.prop('disabled', true);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.attr('action'), true);
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            xhr.setRequestHeader('Accept', 'application/json');

            // Phase 1: Actual upload tracks 0% → 50%
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable && hasMedia) {
                    const rawPercent = (e.loaded / e.total) * 100;
                    const displayPercent = Math.round(rawPercent * 0.5); // map 0-100 → 0-50
                    updateProgressUI(displayPercent, 'Uploading your files...');
                }
            });

            // Phase 2: When upload finishes, simulate 50% → 95% during server processing
            xhr.upload.addEventListener('load', function() {
                if (!hasMedia) return;
                updateProgressUI(50, 'Processing on server... please wait');
                $('#uploadIcon').attr('class', 'fas fa-spinner').css('animation', 'uploadSpin 1s linear infinite');
                let simulated = 50;
                serverTimer = setInterval(function() {
                    if (simulated < 95) {
                        // Slow down as it approaches 95
                        const increment = Math.max(0.3, (95 - simulated) * 0.04);
                        simulated = Math.min(95, simulated + increment);
                        updateProgressUI(simulated, 'Processing on server... please wait');
                    }
                }, 500);
            });

            xhr.onload = function() {
                if (serverTimer) clearInterval(serverTimer);
                if (hasMedia) {
                    updateProgressUI(100, 'Complete!');
                    $('#uploadIcon').attr('class', 'fas fa-check-circle').css('animation', 'none');
                }
                setTimeout(function() { $('#uploadProgressModal').modal('hide'); }, 400);

                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect || "{{ route('admin.packages.index') }}";
                        }, 1500);
                    } else {
                        toastr.error(response.message || 'An error occurred');
                    }
                } else if (xhr.status === 422) {
                    const response = JSON.parse(xhr.responseText);
                    const errors = response.errors;
                    for (const field in errors) {
                        if (field.includes('tracking_locations')) {
                            const matches = field.match(/tracking_locations\.(\d+)\.(\w+)/);
                            if (matches) {
                                const input = $(`input[name="tracking_locations[${matches[1]}][${matches[2]}]"]`);
                                const select = $(`select[name="tracking_locations[${matches[1]}][${matches[2]}]"]`);
                                if (input.length) { input.addClass('is-invalid'); input.after(`<span class="text-danger">${errors[field][0]}</span>`); }
                                else if (select.length) { select.addClass('is-invalid'); select.after(`<span class="text-danger">${errors[field][0]}</span>`); }
                            }
                        } else {
                            const input = $(`[name="${field}"]`);
                            if (input.length) {
                                input.addClass('is-invalid');
                                const errorEl = $(`#${field}_error`);
                                if (errorEl.length) { errorEl.text(errors[field][0]); }
                                else { input.after(`<span class="text-danger" id="${field}_error">${errors[field][0]}</span>`); }
                            }
                        }
                    }
                    toastr.error('Please fix the validation errors');
                } else {
                    toastr.error('An error occurred while updating the package');
                }

                submitText.text('Update Package');
                submitSpinner.addClass('d-none');
                submitBtn.prop('disabled', false);
            };

            xhr.onerror = function() {
                if (serverTimer) clearInterval(serverTimer);
                $('#uploadProgressModal').modal('hide');
                toastr.error('Network error. Please check your connection and try again.');
                submitText.text('Update Package');
                submitSpinner.addClass('d-none');
                submitBtn.prop('disabled', false);
            };

            xhr.send(formData);
        });

        // Date init
        $('input[type="date"]').attr('min', new Date().toISOString().split('T')[0]);
        $('input[type="datetime-local"]').each(function() {
            if (!$(this).val()) $(this).val(new Date().toISOString().slice(0, 16));
        });

        // Multiple image preview
        let selectedImages = new DataTransfer();
        $('#packageImages').on('change', function() {
            const files = this.files;
            if (files.length > 10) { toastr.error('Maximum 10 images allowed'); $(this).val(''); return; }
            selectedImages = new DataTransfer();
            $('#imagePreviews').empty();
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > 2 * 1024 * 1024) { toastr.error('Each image must be smaller than 2MB'); $(this).val(''); $('#imagePreviewContainer').addClass('d-none'); selectedImages = new DataTransfer(); return; }
                selectedImages.items.add(files[i]);
                const reader = new FileReader();
                reader.onload = (function(idx) {
                    return function(e) {
                        const preview = `<div class="position-relative d-inline-block" data-index="${idx}">
                            <img src="${e.target.result}" alt="Preview" class="rounded shadow-sm" style="width: 120px; height: 90px; object-fit: cover;">
                            <span class="badge badge-success position-absolute" style="top: -8px; left: -8px; font-size: 10px;">New</span>
                            <button type="button" class="btn btn-sm btn-danger position-absolute remove-new-image" data-index="${idx}"
                                style="top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0; line-height: 24px; font-size: 11px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>`;
                        $('#imagePreviews').append(preview);
                    };
                })(i);
                reader.readAsDataURL(files[i]);
            }
            $(this).next('.custom-file-label').text(files.length + ' image(s) selected');
            $('#imagePreviewContainer').removeClass('d-none');
        });

        $(document).on('click', '.remove-new-image', function() {
            const idx = $(this).data('index');
            $(this).closest('.position-relative').remove();
            const dt = new DataTransfer();
            for (let i = 0; i < selectedImages.files.length; i++) {
                if (i !== idx) { dt.items.add(selectedImages.files[i]); }
            }
            selectedImages = dt;
            $('#packageImages')[0].files = selectedImages.files;
            if (selectedImages.files.length === 0) {
                $('#imagePreviewContainer').addClass('d-none');
                $('.custom-file-label[for="packageImages"]').text('Add more images...');
            } else {
                $('.custom-file-label[for="packageImages"]').text(selectedImages.files.length + ' image(s) selected');
                $('#imagePreviews .position-relative').each(function(i) { $(this).attr('data-index', i); $(this).find('.remove-new-image').attr('data-index', i); });
            }
        });

        // Multiple video preview
        let selectedVideos = new DataTransfer();
        $('#packageVideos').on('change', function() {
            const files = this.files;
            if (files.length > 5) { toastr.error('Maximum 5 videos allowed'); $(this).val(''); return; }
            selectedVideos = new DataTransfer();
            $('#videoPreviews').empty();
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > 20 * 1024 * 1024) { toastr.error('Each video must be smaller than 20MB'); $(this).val(''); $('#videoPreviewContainer').addClass('d-none'); selectedVideos = new DataTransfer(); return; }
                selectedVideos.items.add(files[i]);
                const url = URL.createObjectURL(files[i]);
                const preview = `<div class="position-relative d-inline-block" data-index="${i}">
                    <video controls class="rounded shadow-sm" style="width: 200px; height: 140px;">
                        <source src="${url}" type="${files[i].type}">
                    </video>
                    <span class="badge badge-success position-absolute" style="top: -8px; left: -8px; font-size: 10px;">New</span>
                    <button type="button" class="btn btn-sm btn-danger position-absolute remove-new-video" data-index="${i}"
                        style="top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0; line-height: 24px; font-size: 11px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`;
                $('#videoPreviews').append(preview);
            }
            $(this).next('.custom-file-label').text(files.length + ' video(s) selected');
            $('#videoPreviewContainer').removeClass('d-none');
        });

        $(document).on('click', '.remove-new-video', function() {
            const idx = $(this).data('index');
            $(this).closest('.position-relative').remove();
            const dt = new DataTransfer();
            for (let i = 0; i < selectedVideos.files.length; i++) {
                if (i !== idx) { dt.items.add(selectedVideos.files[i]); }
            }
            selectedVideos = dt;
            $('#packageVideos')[0].files = selectedVideos.files;
            if (selectedVideos.files.length === 0) {
                $('#videoPreviewContainer').addClass('d-none');
                $('.custom-file-label[for="packageVideos"]').text('Add more videos...');
            } else {
                $('.custom-file-label[for="packageVideos"]').text(selectedVideos.files.length + ' video(s) selected');
                $('#videoPreviews .position-relative').each(function(i) { $(this).attr('data-index', i); $(this).find('.remove-new-video').attr('data-index', i); });
            }
        });

        // Fade existing media when remove checkbox checked
        $(document).on('change', '.remove-image-check', function() {
            $(this).closest('.existing-image-item').find('img').css('opacity', $(this).is(':checked') ? '0.3' : '1');
        });
        $(document).on('change', '.remove-video-check', function() {
            $(this).closest('.existing-video-item').find('video').css('opacity', $(this).is(':checked') ? '0.3' : '1');
        });
    });
</script>