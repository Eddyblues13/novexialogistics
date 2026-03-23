NOVEXIA LOGISTICS - SHIPMENT UPDATE
=====================================

Tracking Number: {{ $package->tracking_number }}

Your Shipment Is On Its Way!

We're excited to let you know that your package has been created and is being processed.

Track your shipment here: {{ $trackingUrl }}

---

SHIPMENT DETAILS
----------------
From: {{ $package->shipping_from ?? 'N/A' }}
To: {{ $package->shipping_to ?? 'N/A' }}

Sender: {{ $package->sender_name }}{{ $package->sender_phone ? ' | ' . $package->sender_phone : '' }}
Receiver: {{ $package->receiver_name }}{{ $package->receiver_phone ? ' | ' . $package->receiver_phone : '' }}

Shipping Date: {{ $package->shipping_date ? $package->shipping_date->format('M d, Y') : 'N/A' }}
Est. Delivery: {{ $package->estimated_delivery_date ? $package->estimated_delivery_date->format('M d, Y') : 'N/A' }}

Description: {{ $package->item_description ?? 'N/A' }}
Weight: {{ $package->total_weight ? $package->total_weight . ' lbs' : 'N/A' }}
No. of Boxes: {{ $package->number_of_boxes ?? 'N/A' }}
Declared Value: {{ $package->declared_value ? '$' . number_format($package->declared_value, 2) : 'N/A' }}

Progress: {{ $package->progress_percentage ?? 25 }}% Complete

@php
$currentLocation = $package->trackingLocations->where('is_current', true)->first()
?? $package->trackingLocations->sortByDesc('arrival_time')->first();
@endphp
@if($currentLocation)
---

CURRENT LOCATION
----------------
{{ $currentLocation->location_name }}
Status: {{ $currentLocation->status }}
@if($currentLocation->arrival_time)
Time: {{ $currentLocation->arrival_time->format('M d, Y \a\t h:i A') }}
@endif
@endif

@if($package->trackingLocations->count() > 1)
---

TRACKING HISTORY
----------------
@foreach($package->trackingLocations->sortByDesc('arrival_time') as $location)
{{ $location->is_current ? '>> ' : ' ' }}{{ $location->location_name }} - {{ $location->status }}{{
$location->arrival_time ? ' (' . $location->arrival_time->format('M d, h:i A') . ')' : '' }}
@endforeach
@endif

@if($package->notes)
---

NOTES: {{ $package->notes }}
@endif

@if($package->image_url)
---
Package Image: {{ $package->image_url }}
@endif

@if($package->video_url)
Package Video: {{ $package->video_url }}
@endif

---

Track your package anytime: {{ $trackingUrl }}

(c) {{ date('Y') }} Novexia Logistics. All rights reserved.
Reliable. Fast. Global Shipping Solutions.

This is an automated notification. Please do not reply to this email.