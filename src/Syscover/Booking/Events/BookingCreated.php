<?php namespace Syscover\Booking\Events;

use Syscover\Booking\Models\Booking;

class BookingCreated
{
    public $booking;

    /**
     * Create a new event instance.
     *
     * @param  Booking  $booking
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->$booking = $booking;
    }
}