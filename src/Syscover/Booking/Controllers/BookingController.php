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

        $vouchersCostAmount = 0;
        $vouchers = $this->request->input('vouchers');
        foreach ($vouchers as $voucher)
        {

        }

        dd($vouchers);

        /**
        Booking::create([
            'date_225'                  => date('U'),
            'date_text_225'             => date(config('pulsar.datePattern')),
            'status_225'                => $this->request->input('status'),

            'customer_id_225'           => $this->request->input('customerId'),
            'customer_name_225'         => $this->request->input('customer'),
            'customer_observations_225' => $this->request->has('customerObservations')? $this->request->input('customerObservations') : null,

            'place_id_225'              => $this->request->input('place'),
            'object_id_225'             => $this->request->input('object'),
            'object_description_225'    => $this->request->has('objectDescription')? $this->request->input('objectDescription') : null,
            'place_observations_225'    => $this->request->has('placeObservations')? $this->request->input('placeObservations') : null,

            'check_in_date_225'         => \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('checkInDate'))->getTimestamp(),
            'check_in_date_text_225'    => $this->request->input('checkInDate'),
            'check_out_date_225'        => \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('checkOutDate'))->getTimestamp(),
            'check_out_date_text_225'   => $this->request->input('checkOutDate'),

            'nights_225'                => $this->request->input('nights'),

            'n_adults_225'              => $this->request->has('nAdults')? $this->request->input('nAdults') : null,
            'n_children_225'            => $this->request->has('nChildren')? $this->request->input('nChildren') : null,
            'n_rooms_225'               => $this->request->has('nRooms')? $this->request->input('nRooms') : null,
            'temporary_beds_225'        => $this->request->has('temporaryBeds')? $this->request->input('temporaryBeds') : null,
            'breakfast_225'             => $this->request->has('breakfast')? $this->request->input('breakfast') : null,


            //**********
            'vouchers_cost_amount_225'  => $this->request->input('vouchersCostAmount'),
            'customer_place_amount_225' => $this->request->input('customerPlaceAmount'),
            'total_amount_225'          => $this->request->input('totalAmount'),
            'commission_percentage_225' => $this->request->input('commissionPercentage'),
            'amount_on_commission_225'  => $this->request->input('amountOnCommission'),
            'commission_amount_225'     => $this->request->input('commissionAmount'),
            //****************

            'observations_225'          => $this->request->has('observations')? $this->request->input('observations') : null,
        ]);
         */
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