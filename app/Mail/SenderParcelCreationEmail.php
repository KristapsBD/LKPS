<?php

namespace App\Mail;

use App\Models\Parcel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SenderParcelCreationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $parcel;

    /**
     * Create a new message instance.
     */
    public function __construct(Parcel $parcel)
    {
        $this->parcel = $parcel;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Parcel Created: ' . $this->parcel->tracking_code,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.parcel-created-sender',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
