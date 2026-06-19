<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🚨 New Contact Message Received from BACTA Portal',
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: "
                <h3>Dear Admin,</h3>
                <p>A new query message has been dispatched from the BACTA website contact form.</p>
                <hr>
                <p><strong>👨‍⚕️ Doctor Name:</strong> {$this->formData['name']}</p>
                <p><strong>✉️ Email Address:</strong> {$this->formData['email']}</p>
                <p><strong>📞 Mobile Number:</strong> {$this->formData['mobile']}</p>
                <p><strong>💬 Message Body:</strong><br>{$this->formData['message']}</p>
                <hr>
                <p>This is an automated security audit notification from your server gate.</p>
            "
        );
    }
}
