<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;


    public $reservation;
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build(): ReservationMail
    {
        return $this->subject('طلب حجز جديد')
            ->view('reservation')
            ->with([
                'name' => $this->reservation->name,
                'phone' => $this->reservation->phone,
                'property' => $this->reservation->property->title,
                'address' => $this->reservation->property->address,
                'description' => $this->reservation->property->description,
                'date' => $this->reservation->date,
                'time' => $this->reservation->time,
                'partner' => $this->reservation->partner->name ?? 'لم يتم اختيار شريك',
            ]);
    }
}
