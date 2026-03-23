<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $emailSubject;
    public string $emailBody;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subject, string $body)
    {
        $this->emailSubject = $subject;
        $this->emailBody = $body;
    }

    /**
     * Get the message headers.
     */
    public function headers(): Headers
    {
        return new Headers(
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name')),
            ],
            text: [
                'X-Mailer' => 'Novexia Logistics Mailer',
                'Organization' => 'Novexia Logistics',
                'X-Priority' => '3',
            ],
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.custom',
            text: 'emails.custom-text',
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
