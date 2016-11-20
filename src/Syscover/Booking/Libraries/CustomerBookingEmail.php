<?php

namespace Syscover\Booking\Libraries;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Syscover\Booking\Models\Booking;

class CustomerBookingEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;
    protected $establishment;
    protected $vouchers;
    protected $attachment;

    public function __construct(Booking $booking, $establishment, $vouchers = [], $attachment = null)
    {
        $this->booking          = $booking;
        $this->establishment    = $establishment;
        $this->vouchers         = $vouchers;
        $this->attachment       = $attachment;
    }

    public function build()
    {
        return $this->view('booking::emails.customer_booking_notification')
            ->with(['booking' => $this->booking, 'establishment' => $this->establishment, 'vouchers' => $this->vouchers, 'attachment' => $this->attachment]);
    }
}