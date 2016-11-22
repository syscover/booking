<?php

namespace Syscover\Booking\Libraries;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Syscover\Booking\Models\Booking;

class BookingEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;
    protected $establishment;
    protected $vouchers;
    protected $attachment;

    public function __construct($view, $subject, Booking $booking, $establishment, $vouchers = [], $attachment = null, $masterCardFeatures)
    {
        $this->view                 = $view;
        $this->subject              = $subject;
        $this->booking              = $booking;
        $this->establishment        = $establishment;
        $this->vouchers             = $vouchers;
        $this->attachment           = $attachment;
        $this->masterCardFeatures   = $masterCardFeatures;
    }

    public function build()
    {
        return $this->with([
                'booking'               => $this->booking,
                'establishment'         => $this->establishment,
                'vouchers'              => $this->vouchers,
                'attachment'            => $this->attachment,
                'masterCardFeatures'    => $this->masterCardFeatures
            ]);
    }
}