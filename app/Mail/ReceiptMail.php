<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $name, public string $invoiceUrl)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Receipt from ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.receipt',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
