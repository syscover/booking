<?php namespace Syscover\Booking\Controllers;

use Syscover\Booking\Models\Place;
use Syscover\Hotels\Models\Hotel;
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

    public function createCustomRecord($parameters)
    {
        $parameters['statuses'] = array_map(function($object){
            $object->name = trans($object->name);
            return $object;
        }, config('booking.status'));

        $parameters['places']   = Place::builder()->get();
        $parameters['hotels']   = Hotel::builder()->get();

        $parameters['nAdults']   = range(0, 29);
        array_walk($parameters['nAdults'], function(&$object, $key) {
            $object         = new \stdClass();
            $object->id     = $key + 1;
            $object->name   = ($key + 1) . ' ' . trans_choice('pulsar::pulsar.adult', ($key + 1));
        });

        $parameters['nChildren']   = range(0, 9);
        array_walk($parameters['nChildren'], function(&$object, $key) {
            $object         = new \stdClass();
            $object->id     = $key + 1;
            $object->name   = ($key + 1) . ' ' . trans_choice('pulsar::pulsar.child', ($key + 1));
        });

        $parameters['nRooms']   = range(0, 29);
        array_walk($parameters['nRooms'], function(&$object, $key) {
            $object         = new \stdClass();
            $object->id     = $key + 1;
            $object->name   = ($key + 1) . ' ' . trans_choice('hotels::pulsar.room', ($key + 1));
        });

        $parameters['temporaryBeds']   = range(0, 4);
        array_walk($parameters['temporaryBeds'], function(&$object, $key) {
            $object         = new \stdClass();
            $object->id     = $key + 1;
            $object->name   = ($key + 1) . ' ' . trans_choice('booking::pulsar.temporary_bed', ($key + 1));
        });

        $parameters['breakfast']    = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('booking.breakfast'));




        return $parameters;
    }

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