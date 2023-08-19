<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailToOwners extends Mailable
{
    use Queueable, SerializesModels;

    public $header, $greetings, $firstParagraph, $secondParagraph, $thanks, $authorName;
    /**
     * Create a new message instance.
     */
    public function __construct($header, $greetings, $firstParagraph, $secondParagraph, $thanks, $authorName)
    {
        $this->header = $header;
        $this->greetings = $greetings;
        $this->firstParagraph = $firstParagraph;
        $this->secondParagraph = $secondParagraph;
        $this->thanks = $thanks;
        $this->authorName = $authorName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-mail Clínica Veterinária',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.email',
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
