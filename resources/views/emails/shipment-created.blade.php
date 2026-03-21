<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings xmlns:o="urn:schemas-microsoft-com:office:office">
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <style>
        td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
    <![endif]-->
    <style>
        /* Reset */
        body,
        table,
        td,
        p,
        a,
        li,
        blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
            background-color: #f0f4f8;
        }

        /* Typography */
        .email-body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Responsive */
        @media only screen and (max-width: 620px) {
            .container {
                width: 100% !important;
                padding: 0 16px !important;
            }

            .mobile-padding {
                padding: 24px 20px !important;
            }

            .tracking-number {
                font-size: 22px !important;
                letter-spacing: 2px !important;
            }

            .hero-title {
                font-size: 22px !important;
            }

            .detail-table td {
                display: block !important;
                width: 100% !important;
                padding: 6px 0 !important;
            }

            .cta-button {
                width: 100% !important;
            }

            .progress-step {
                padding: 0 4px !important;
            }
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            .email-bg {
                background-color: #1a1a2e !important;
            }

            .card-bg {
                background-color: #16213e !important;
            }

            .text-primary {
                color: #e0e0e0 !important;
            }

            .text-secondary {
                color: #b0b0b0 !important;
            }
        }
    </style>
</head>

<body class="email-body" style="margin: 0; padding: 0; background-color: #f0f4f8;">
    <!-- Preheader -->
    <div style="display: none; max-height: 0; overflow: hidden; mso-hide: all;">
        Your shipment {{ $package->tracking_number }} has been created and is on its way! Track your package in
        real-time.
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="email-bg"
        style="background-color: #f0f4f8;">
        <tr>
            <td align="center" style="padding: 32px 16px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" class="container"
                    style="width: 600px; max-width: 600px;">

                    {{-- ===== HEADER / LOGO BAR ===== --}}
                    <tr>
                        <td align="center" style="padding-bottom: 24px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <span
                                            style="font-size: 26px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; text-decoration: none;">
                                            📦 {{ config('app.name', 'Novexia Logistics') }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== TRACKING NUMBER HERO ===== --}}
                    <tr>
                        <td style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0ea5e9 100%); border-radius: 16px 16px 0 0; padding: 40px 32px; text-align: center;"
                            class="mobile-padding">
                            <!-- Gradient fallback for Outlook -->
                            <!--[if mso]>
                            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:200px;">
                                <v:fill type="gradient" color="#0f172a" color2="#0ea5e9" angle="135"/>
                                <v:textbox inset="0,0,0,0">
                            <![endif]-->
                            <p
                                style="margin: 0 0 8px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 3px; color: rgba(255,255,255,0.7);">
                                Tracking Number
                            </p>
                            <p class="tracking-number"
                                style="margin: 0 0 16px; font-size: 30px; font-weight: 800; color: #ffffff; letter-spacing: 3px; font-family: 'Courier New', monospace;">
                                {{ $package->tracking_number }}
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    <td
                                        style="background-color: rgba(255,255,255,0.15); border-radius: 20px; padding: 6px 16px;">
                                        <span style="font-size: 12px; font-weight: 600; color: #ffffff;">
                                            @if($package->current_step >= 4)
                                            ✅ Delivered
                                            @elseif($package->current_step >= 3)
                                            🚚 Out for Delivery
                                            @elseif($package->current_step >= 2)
                                            📍 In Transit
                                            @else
                                            📋 Processing
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <!--[if mso]></v:textbox></v:rect><![endif]-->
                        </td>
                    </tr>

                    {{-- ===== CTA BUTTON ===== --}}
                    <tr>
                        <td
                            style="background-color: #ffffff; padding: 32px; text-align: center; border-bottom: 1px solid #e2e8f0;">
                            <p class="hero-title"
                                style="margin: 0 0 8px; font-size: 24px; font-weight: 700; color: #0f172a;">
                                Your Shipment Is On Its Way!
                            </p>
                            <p style="margin: 0 0 24px; font-size: 15px; color: #64748b; line-height: 1.6;">
                                We're excited to let you know that your package has been created and is being processed.
                                Click below to track your shipment in real-time.
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    <td class="cta-button"
                                        style="border-radius: 12px; background: linear-gradient(135deg, #0ea5e9, #2563eb);">
                                        <!--[if mso]>
                                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" href="{{ $trackingUrl }}" style="height:48px;v-text-anchor:middle;width:280px;" arcsize="25%" strokecolor="#0ea5e9" fillcolor="#0ea5e9">
                                            <w:anchorlock/>
                                            <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">Track Your Shipment →</center>
                                        </v:roundrect>
                                        <![endif]-->
                                        <!--[if !mso]><!-->
                                        <a href="{{ $trackingUrl }}" target="_blank"
                                            style="display: inline-block; padding: 14px 40px; font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 12px; background: linear-gradient(135deg, #0ea5e9, #2563eb); box-shadow: 0 4px 14px rgba(14,165,233,0.4);">
                                            Track Your Shipment →
                                        </a>
                                        <!--<![endif]-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== PROGRESS STEPS ===== --}}
                    <tr>
                        <td style="background-color: #ffffff; padding: 28px 32px;" class="mobile-padding">
                            <p
                                style="margin: 0 0 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #94a3b8;">
                                Shipment Progress
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    @php
                                    $steps = [
                                    1 => $package->step1_name ?? 'Processing',
                                    2 => $package->step2_name ?? 'In Transit',
                                    3 => $package->step3_name ?? 'Out for Delivery',
                                    4 => $package->step4_name ?? 'Delivered',
                                    ];
                                    $currentStep = $package->current_step ?? 1;
                                    @endphp
                                    @foreach($steps as $num => $name)
                                    <td align="center" class="progress-step" style="padding: 0 8px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td align="center">
                                                    @if($num <= $currentStep) <div
                                                        style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #0ea5e9, #2563eb); color: #ffffff; font-size: 14px; font-weight: 700; line-height: 36px; text-align: center;">
                                                        @if($num < $currentStep) ✓ @else {{ $num }} @endif </div>
                                                            @else
                                                            <div
                                                                style="width: 36px; height: 36px; border-radius: 50%; background-color: #e2e8f0; color: #94a3b8; font-size: 14px; font-weight: 700; line-height: 36px; text-align: center;">
                                                                {{ $num }}
                                                            </div>
                                                            @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding-top: 8px;">
                                                    <span
                                                        style="font-size: 11px; font-weight: 600; color: {{ $num <= $currentStep ? '#0f172a' : '#94a3b8' }};">
                                                        {{ $name }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    @endforeach
                                </tr>
                            </table>
                            {{-- Progress bar --}}
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="margin-top: 16px;">
                                <tr>
                                    <td style="background-color: #e2e8f0; border-radius: 4px; height: 6px;">
                                        <div
                                            style="width: {{ $package->progress_percentage ?? 25 }}%; height: 6px; border-radius: 4px; background: linear-gradient(90deg, #0ea5e9, #2563eb);">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <p
                                style="margin: 10px 0 0; text-align: right; font-size: 12px; font-weight: 700; color: #0ea5e9;">
                                {{ $package->progress_percentage ?? 25 }}% Complete
                            </p>
                        </td>
                    </tr>

                    {{-- ===== SHIPMENT DETAILS ===== --}}
                    <tr>
                        <td style="background-color: #ffffff; padding: 0 32px 28px;" class="mobile-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                                {{-- Section Header --}}
                                <tr>
                                    <td colspan="2"
                                        style="background-color: #f8fafc; padding: 14px 20px; border-bottom: 1px solid #e2e8f0;">
                                        <span
                                            style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #475569;">
                                            📋 Shipment Details
                                        </span>
                                    </td>
                                </tr>
                                {{-- From / To --}}
                                <tr class="detail-table">
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; width: 50%; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">From</span><br>
                                        <span style="font-size: 14px; font-weight: 600; color: #0f172a;">{{
                                            $package->shipping_from ?? 'N/A' }}</span>
                                    </td>
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; width: 50%; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">To</span><br>
                                        <span style="font-size: 14px; font-weight: 600; color: #0f172a;">{{
                                            $package->shipping_to ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                {{-- Sender / Receiver --}}
                                <tr class="detail-table">
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Sender</span><br>
                                        <span style="font-size: 14px; font-weight: 600; color: #0f172a;">{{
                                            $package->sender_name }}</span><br>
                                        @if($package->sender_phone)
                                        <span style="font-size: 12px; color: #64748b;">{{ $package->sender_phone
                                            }}</span>
                                        @endif
                                    </td>
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Receiver</span><br>
                                        <span style="font-size: 14px; font-weight: 600; color: #0f172a;">{{
                                            $package->receiver_name }}</span><br>
                                        @if($package->receiver_phone)
                                        <span style="font-size: 12px; color: #64748b;">{{ $package->receiver_phone
                                            }}</span>
                                        @endif
                                    </td>
                                </tr>
                                {{-- Shipping Date / Est. Delivery --}}
                                <tr class="detail-table">
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Shipping
                                            Date</span><br>
                                        <span style="font-size: 14px; font-weight: 600; color: #0f172a;">
                                            {{ $package->shipping_date ? $package->shipping_date->format('M d, Y') :
                                            'N/A' }}
                                        </span>
                                    </td>
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Est.
                                            Delivery</span><br>
                                        <span style="font-size: 14px; font-weight: 600; color: #0ea5e9;">
                                            {{ $package->estimated_delivery_date ?
                                            $package->estimated_delivery_date->format('M d, Y') : 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                {{-- Package Info --}}
                                <tr class="detail-table">
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Description</span><br>
                                        <span style="font-size: 14px; color: #334155;">{{ $package->item_description ??
                                            'N/A' }}</span>
                                    </td>
                                    <td
                                        style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Weight</span><br>
                                        <span style="font-size: 14px; color: #334155;">{{ $package->total_weight ?
                                            $package->total_weight . ' lbs' : 'N/A' }}</span>
                                    </td>
                                </tr>
                                {{-- Boxes / Value --}}
                                <tr class="detail-table">
                                    <td style="padding: 14px 20px; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">No.
                                            of Boxes</span><br>
                                        <span style="font-size: 14px; color: #334155;">{{ $package->number_of_boxes ??
                                            'N/A' }}</span>
                                    </td>
                                    <td style="padding: 14px 20px; vertical-align: top;">
                                        <span
                                            style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">Declared
                                            Value</span><br>
                                        <span style="font-size: 14px; color: #334155;">{{ $package->declared_value ? '$'
                                            . number_format($package->declared_value, 2) : 'N/A' }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== CURRENT LOCATION ===== --}}
                    @php
                    $currentLocation = $package->trackingLocations->where('is_current', true)->first()
                    ?? $package->trackingLocations->sortByDesc('arrival_time')->first();
                    @endphp
                    @if($currentLocation)
                    <tr>
                        <td style="background-color: #ffffff; padding: 0 32px 28px;" class="mobile-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 12px; border: 1px solid #bae6fd;">
                                <tr>
                                    <td style="padding: 20px 24px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                            width="100%">
                                            <tr>
                                                <td style="vertical-align: middle; width: 48px;">
                                                    <div
                                                        style="width: 44px; height: 44px; background: linear-gradient(135deg, #0ea5e9, #2563eb); border-radius: 12px; text-align: center; line-height: 44px; font-size: 20px;">
                                                        📍
                                                    </div>
                                                </td>
                                                <td style="padding-left: 16px; vertical-align: middle;">
                                                    <p
                                                        style="margin: 0; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; color: #0369a1;">
                                                        Current Location
                                                    </p>
                                                    <p
                                                        style="margin: 4px 0 0; font-size: 17px; font-weight: 700; color: #0f172a;">
                                                        {{ $currentLocation->location_name }}
                                                    </p>
                                                    <p style="margin: 4px 0 0; font-size: 13px; color: #475569;">
                                                        {{ $currentLocation->status }}
                                                        @if($currentLocation->arrival_time)
                                                        &bull; {{ $currentLocation->arrival_time->format('M d, Y \a\t
                                                        h:i A') }}
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- ===== TRACKING HISTORY ===== --}}
                    @if($package->trackingLocations->count() > 1)
                    <tr>
                        <td style="background-color: #ffffff; padding: 0 32px 28px;" class="mobile-padding">
                            <p
                                style="margin: 0 0 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #94a3b8;">
                                Tracking History
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                @foreach($package->trackingLocations->sortByDesc('arrival_time') as $location)
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                            width="100%">
                                            <tr>
                                                <td style="width: 10px; vertical-align: top; padding-top: 6px;">
                                                    <div
                                                        style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $location->is_current ? '#0ea5e9' : '#cbd5e1' }};">
                                                    </div>
                                                </td>
                                                <td style="padding-left: 14px;">
                                                    <p
                                                        style="margin: 0; font-size: 14px; font-weight: 600; color: #0f172a;">
                                                        {{ $location->location_name }}
                                                    </p>
                                                    <p style="margin: 2px 0 0; font-size: 13px; color: #64748b;">
                                                        {{ $location->status }}
                                                    </p>
                                                </td>
                                                <td align="right" style="vertical-align: top;">
                                                    <span style="font-size: 12px; color: #94a3b8;">
                                                        {{ $location->arrival_time ? $location->arrival_time->format('M
                                                        d, h:i A') : '' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- ===== NOTES ===== --}}
                    @if($package->notes)
                    <tr>
                        <td style="background-color: #ffffff; padding: 0 32px 28px;" class="mobile-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="background-color: #fffbeb; border-radius: 12px; border: 1px solid #fde68a;">
                                <tr>
                                    <td style="padding: 16px 20px;">
                                        <p style="margin: 0 0 4px; font-size: 12px; font-weight: 700; color: #92400e;">
                                            ⚠️ Notes</p>
                                        <p style="margin: 0; font-size: 14px; color: #78350f; line-height: 1.5;">{{
                                            $package->notes }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- ===== PACKAGE IMAGE ===== --}}
                    @if($package->image_url)
                    <tr>
                        <td style="background-color: #ffffff; padding: 0 32px 28px;" class="mobile-padding">
                            <p
                                style="margin: 0 0 12px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #94a3b8;">
                                📸 Package Image
                            </p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                                <tr>
                                    <td align="center" style="padding: 0;">
                                        <img src="{{ $package->image_url }}" alt="Package Image"
                                            style="display: block; width: 100%; max-width: 536px; height: auto; border-radius: 12px;" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- ===== SECOND CTA ===== --}}
                    <tr>
                        <td style="background-color: #ffffff; padding: 8px 32px 32px; text-align: center; border-radius: 0 0 16px 16px;"
                            class="mobile-padding">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="border-top: 1px solid #e2e8f0;">
                                <tr>
                                    <td style="padding-top: 24px; text-align: center;">
                                        <p style="margin: 0 0 16px; font-size: 14px; color: #64748b;">
                                            Bookmark this link to check your tracking status anytime:
                                        </p>
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                            align="center">
                                            <tr>
                                                <td
                                                    style="background-color: #f1f5f9; border-radius: 8px; padding: 10px 20px;">
                                                    <a href="{{ $trackingUrl }}"
                                                        style="font-size: 13px; color: #0ea5e9; text-decoration: none; font-weight: 600; word-break: break-all;">
                                                        {{ $trackingUrl }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== FOOTER ===== --}}
                    <tr>
                        <td style="padding: 32px 32px 16px; text-align: center;">
                            <p style="margin: 0 0 8px; font-size: 14px; font-weight: 700; color: #475569;">
                                {{ config('app.name', 'Novexia Logistics') }}
                            </p>
                            <p style="margin: 0 0 16px; font-size: 13px; color: #94a3b8; line-height: 1.5;">
                                Reliable. Fast. Global Shipping Solutions.
                            </p>
                            <p style="margin: 0; font-size: 12px; color: #cbd5e1;">
                                This is an automated notification. Please do not reply to this email.<br>
                                If you have questions, contact our support team.
                            </p>
                            <p style="margin: 16px 0 0; font-size: 11px; color: #e2e8f0;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Novexia Logistics') }}. All rights
                                reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>