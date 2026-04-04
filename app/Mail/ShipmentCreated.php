<?php

namespace App\Mail;

use App\Models\Package;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

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
     * Get the message headers.
     */
    public function headers(): Headers
    {
        return new Headers(
            text: [
                'X-Mailer' => 'Novexia Logistics Mailer',
                'Organization' => 'Novexia Logistics',
                'X-Priority' => '3',
                'Precedence' => 'bulk',
            ],
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment Update - Tracking #' . $this->package->tracking_number,
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name')),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipment-created',
            text: 'emails.shipment-created-text',
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
