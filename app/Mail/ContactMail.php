<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $images;

    public function __construct($data, $images)
    {
        $this->data = $data;
        $this->images = $images;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'contact.form-submit',
            with: ['subject' => $this->data['subject'], 'body' => $this->data['body']]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->images) {
            foreach ($this->images as $path) {
                $attachments[] = Attachment::fromPath(storage_path('app/public/' . $path));
            }
        }

        return $attachments;
    }
}
