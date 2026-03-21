<?php

namespace App\Mail;

use App\Models\Package;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Package $package;
    public string $trackingUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Package $package)
    {
        $this->package = $package;
        $this->trackingUrl = url('/package?search=' . $package->tracking_number);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Shipment Has Been Created — Tracking #' . $this->package->tracking_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipment-created',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
