<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Car;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $start_date;
    public $end_date;
    public $name;
    public $phone;

    public function __construct(Car $car, $start_date, $end_date, $name, $phone)
    {
        $this->car = $car;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->name = $name;
        $this->phone = $phone;
    }

    public function build()
    {
        return $this->view('emails.booking_confirmation')
                    ->with([
                        'confirmUrl' => url("/confirm-booking?car_id={$this->car->id}&start_date={$this->start_date}&end_date={$this->end_date}")
                    ]);
    }
}
