<?php namespace Syscover\Booking\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\Booking;

/**
 * Class BookingController
 * @package Syscover\Booking\Controllers
 */

class BookingController extends Controller
{
    protected $routeSuffix  = 'bookingBooking';
    protected $folder       = 'booking';
    protected $package      = 'booking';
    protected $indexColumns = ['id_225', 'name_221', 'prefix_221', ['data' => 'active_221', 'type' => 'active']];
    protected $nameM        = 'name_221';
    protected $model        = Booking::class;
    protected $icon         = 'fa fa-hourglass-end';
    protected $objectTrans  = 'booking';
    
    public function storeCustomRecord($parameters)
    {
//        Campaign::create([
//            'name_221'      => $this->request->input('name'),
//            'prefix_221'    => $this->request->input('prefix'),
//            'active_221'    => $this->request->has('active')
//        ]);
    }

    public function updateCustomRecord($parameters)
    {
//        Campaign::where('id_221', $parameters['id'])->update([
//            'name_221'      => $this->request->input('name'),
//            'prefix_221'    => $this->request->input('prefix'),
//            'active_221'    => $this->request->has('active')
//        ]);
    }
}