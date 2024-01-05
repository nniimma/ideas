<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    // * we can remove this line downside:
    private User $user;

    /**
     * Create a new message instance.
     */
    // ! from php 8 and above we can remove the ones that I am showing with green and for passing data to view just putting User $user in the constructor:
    public function __construct(User $user)
    {
        // * we can remove this line downside:
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to' . env('APP_NAME', '')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-email',
            // ! here is for passing data to blade file:
            with: ['user' => $this->user]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // ! here we can attach images:
    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', 'profile/3IoT9N3rt61W7YRp0W9aZ9kssbrLY0BPoFDFSUJw.png')
        ];
    }
}
