<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ContactUs $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('طلب تواصل جديد')
            ->view('contact_us')
            ->with([
                'name' => $this->contact->name,
                'email' => $this->contact->email,
                'contactMessage' => $this->contact->message,
            ]);
    }
}