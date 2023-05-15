<?php

namespace App\Mail;

use App\Models\Contactpersonen;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateDetailsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactPerson;
    public $url;

    /**
     * Create a new message instance.
     *
     * @param  Contactpersonen  $contactPerson
     * @param  string  $url
     * @return void
     */

    public function __construct(Contactpersonen $contactPerson, $url)
    {
        $this->contactPerson = $contactPerson;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Update Your Details')
            ->view('emails.update-details');
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
