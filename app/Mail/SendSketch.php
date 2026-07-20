<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class SendSketch extends Mailable
{
    use Queueable, SerializesModels;

    public $imagePath;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @param string $imagePath
     */
    public function __construct(string $imagePath, string $userName)
    {
        $this->imagePath = $imagePath;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Sketch',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return new Content(
        //     view: 'view.name',
        // );
        return new Content(
            view: 'emails.send_sketch',
            with: [
                'imageUrl' => $this->imagePath,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        //  return [
        //     $this->imagePath => [
        //         'as' => $this->imageName,
        //         'mime' => mime_content_type($this->imagePath),
        //     ],
        // ];
        // return [
        //     Attachment::fromPath($this->imagePath)
        //         ->as($this->imageName)
        //         ->withMime('image/png'), // Set the correct MIME type
        //         // ->withMime(mime_content_type($this->imagePath)),
        // ];
       return [
            Attachment::fromPath(public_path($this->imagePath))
            // ->as($this->imageName)
                ->as('soulmate_sketch.png') // Optional: change the attachment name
                ->withMime('image/png'), // Ensures the correct MIME type
        ];
    }
}
