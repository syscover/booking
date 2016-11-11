<?php namespace Syscover\Booking\Controllers;

use Syscover\Booking\Models\Place;
use Syscover\Hotels\Models\Hotel;
use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\Booking;
use Syscover\Booking\Models\Voucher;

/**
 * Class BookingController
 * @package Syscover\Booking\Controllers
 */

class BookingController extends Controller {
    protected $routeSuffix  = 'bookingBooking';
    protected $folder       = 'booking';
    protected $package      = 'booking';
    protected $indexColumns = ['id_225', 'date_text_225','customer_name_225'];
    protected $nameM        = 'name_221';
    protected $model        = Booking::class;
    protected $icon         = 'fa fa-hourglass-end';
    protected $objectTrans  = 'booking';

    private function commonCustomRecord($parameters) {
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

        $parameters['commissions'] = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('booking.commissions'));

        return $parameters;
    }

    public function createCustomRecord($parameters) {
        return $this->commonCustomRecord($parameters);
    }

    public function storeCustomRecord($parameters) {

        $vouchersPaidAmount = 0;
        $vouchersCostAmount = 0;
        if($this->request->has('vouchers')) {
            $vouchers = $this->request->input('vouchers');
            foreach ($vouchers as $voucher) {
                $vouchersPaidAmount += (float)$this->request->input('voucherPaid-' . $voucher);
                $vouchersCostAmount += (float)$this->request->input('voucherCost-' . $voucher);
            }
        }
                
        $booking = Booking::create([
            'date_225'                      => date('U'),
            'date_text_225'                 => date(config('pulsar.datePattern')),
            'status_225'                    => $this->request->input('status'),

            'customer_id_225'               => $this->request->input('customerId'),
            'customer_name_225'             => $this->request->input('customer'),
            'customer_observations_225'     => $this->request->has('customerObservations')? $this->request->input('customerObservations') : null,

            'place_id_225'                  => $this->request->input('place'),
            'object_id_225'                 => $this->request->input('object'),
            'object_description_225'        => $this->request->has('objectDescription')? $this->request->input('objectDescription') : null,
            'place_observations_225'        => $this->request->has('placeObservations')? $this->request->input('placeObservations') : null,

            'check_in_date_225'             => \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('checkInDate'))->getTimestamp(),
            'check_in_date_text_225'        => $this->request->input('checkInDate'),
            'check_out_date_225'            => \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('checkOutDate'))->getTimestamp(),
            'check_out_date_text_225'       => $this->request->input('checkOutDate'),

            'nights_225'                    => $this->request->input('nights'),

            'n_adults_225'                  => $this->request->has('nAdults')? $this->request->input('nAdults') : null,
            'n_children_225'                => $this->request->has('nChildren')? $this->request->input('nChildren') : null,
            'n_rooms_225'                   => $this->request->has('nRooms')? $this->request->input('nRooms') : null,
            'temporary_beds_225'            => $this->request->has('temporaryBeds')? $this->request->input('temporaryBeds') : null,
            'breakfast_225'                 => $this->request->has('breakfast')? $this->request->input('breakfast') : null,
            
            'vouchers_paid_amount_225'      => $vouchersPaidAmount,
            'vouchers_cost_amount_225'      => $vouchersCostAmount,
            'direct_payment_amount_225'     => $this->request->has('directPaymenAmount')? $this->request->input('directPaymenAmount') : 0,
            'total_amount_225'              => $this->request->input('totalAmount'),
            
            'commission_percentage_225'     => $this->request->input('commissionPercentage'),
            'commission_calculation_225'    => $this->request->input('commissionCalculation'),
            'commission_amount_225'         => $this->request->input('commissionAmount'),

            'observations_225'              => $this->request->has('observations')? $this->request->input('observations') : null,
        ]);

        // update vouchers with booking
        /*foreach ($vouchers as $voucher)
        {
            Voucher::where('id_226', voucher)->update([
                'has_used_226'      => true,
                'used_date_226'             ?? esta fecha es el pirmer días que entra día de la reserva día de uso....
                'used_date_text_226'
                'booking_id_226'    => $booking->id_225,
                'place_id_226'      => $this->request->input('place'),
                'object_id_226'     => $this->request->input('object'),
                'cost_2260'         => (float)$this->request->input('voucherCost-' . $voucher),
                'paid_226'                          ?? esto que era???
                'place_payout_date_226'
                'place_payout_date_text_226'
            ]);
        }*/
    }

    public function editCustomRecord($parameters) {
        return $this->commonCustomRecord($parameters);
    }

    public function updateCustomRecord($parameters) {

    }
}