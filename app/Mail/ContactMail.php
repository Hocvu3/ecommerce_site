<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $User_name;
    public $User_email;
    public $User_subject;
    public $User_message;
    /**
     * Create a new message instance.
     */
    public function __construct($User_name, $User_email, $User_subject, $User_message)
    {
        $this->User_name = $User_name;
        $this->User_email = $User_email;
        $this->User_subject = $User_subject;
        $this->User_message = $User_message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->User_subject,
            from: $this->User_email,
            to: config('settingsService.mail_receive_address'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-mail',
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
