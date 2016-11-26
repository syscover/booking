<?php namespace Syscover\Booking\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Syscover\Pulsar\Core\Controller;
use Syscover\Pulsar\Models\Attachment;
use Syscover\Pulsar\Models\CustomField;
use Syscover\Booking\Libraries\BookingEmail;
use Syscover\Booking\Models\Place;
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
    protected $indexColumns = ['id_225', 'status_text_225', 'date_225', 'date_text_225', 'check_out_date_225', 'check_out_date_text_225', 'object_name_225', 'customer_name_225'];
    protected $nameM        = 'name_221';
    protected $model        = Booking::class;
    protected $icon         = 'fa fa-hourglass-end';
    protected $objectTrans  = 'booking';

    function __construct(Request $request)
    {
        parent::__construct($request);

        $this->viewParameters['deleteButton']       = false;
        $this->viewParameters['deleteSelectButton'] = false;
    }

    public function jsonCustomDataBeforeActions($aObject, $actionUrlParameters, $parameters)
    {
        if($aObject['status_225'] == 3)
        {
            $this->viewParameters['editButton']     = false;
            $this->viewParameters['showButton']     = true;
        }
        else
        {
            $this->viewParameters['editButton']     = true;
            $this->viewParameters['showButton']     = false;
        }
    }

    private function commonCustomRecord($parameters) 
    {
        $parameters['statuses'] = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('booking.status'));

        $parameters['places']   = Place::builder()->get();

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

        $parameters['taxes'] = array_map(function($object) {
            if(trans_has($object->name))
                $object->name = trans($object->name);
            return $object;
        }, config('booking.taxes'));

        return $parameters;
    }

    public function createCustomRecord($parameters) 
    {
        $parameters = $this->commonCustomRecord($parameters);

        // delete cancel option on create action
        unset($parameters['statuses'][2]);

        //$parameters['afterButtonFooter'] = '<a class="btn btn-info margin-l10" onclick="$.saveBookingDraft()" href="#">' . trans('booking::pulsar.save_draft') . '</a>';

        return $parameters;
    }

    public function storeCustomRecord($parameters) 
    {
        $vouchersProperties = $this->getVouchersProperties();

        $booking = Booking::create([
            'date_225'                      => date('U'),
            'date_text_225'                 => date(config('pulsar.datePattern')),
            'status_225'                    => $this->request->input('status'),
            'status_text_225'               => trans(collect(config('booking.status'))->where('id', $this->request->input('status'))->first()->name),

            'customer_id_225'               => $this->request->input('customerId'),
            'customer_name_225'             => $this->request->input('customer'),
            'customer_observations_225'     => $this->request->has('customerObservations')? $this->request->input('customerObservations') : null,

            'place_id_225'                  => $this->request->input('place'),
            'object_id_225'                 => $this->request->input('object'),
            'object_name_225'               => $this->request->input('objectName'),
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
            
            'vouchers_paid_amount_225'      => $vouchersProperties['vouchersPaidAmount'],
            'vouchers_cost_amount_225'      => $vouchersProperties['vouchersCostAmount'],
            'direct_payment_amount_225'     => $this->request->has('directPaymenAmount')? $this->request->input('directPaymenAmount') : 0,
            'total_amount_225'              => $this->request->input('totalAmount'),
            'tax_percentage_225'            => $this->request->input('taxPercentage'),
            
            'commission_percentage_225'     => $this->request->input('commissionPercentage'),
            'commission_calculation_225'    => $this->request->input('commissionCalculation'),
            'commission_amount_225'         => $this->request->input('commissionAmount'),

            'observations_225'              => $this->request->has('observations')? $this->request->input('observations') : null,

            'data_225'                      => json_encode($vouchersProperties['vouchersId'])
        ]);

        $this->setVouchersToRegister($vouchersProperties['vouchersId'], $booking);

        // overwrite variable with relation data
        $booking = Booking::builder()->where('id_225', $booking->id_225)->first();

        $this->sendEmails($booking);
    }

    public function editCustomRecord($parameters)
    {
        $parameters = $this->commonCustomRecord($parameters);

        // objects from place
        if(isset($parameters['object']->place_id_225))
        {
            $result = collect(config('booking.models'))->where('id', $parameters['object']->place_id_225);

            if (count($result) === 0)
                return response()->json([
                    'status'    => 'error',
                    'code'      => 404,
                    'message'   => 'Records not found'
                ]);

            // model constructor
            $model                      = App::make($result->first()->model);

            // use sofa to get lang from lang table of object query
            $parameters['objects']      = $model->builder()->where('lang_id', base_lang()->id_001)->get();
            $parameters['objectName']   = trans_choice($result->first()->name, 1);
            $parameters['objectKey']    = $model->getKeyName();
        }

        $parameters['vouchers'] = Voucher::builder()->where('booking_id_226', $parameters['object']->id_225)->get();

        $parameters['afterButtonFooter'] = '<a class="btn btn-info margin-l10" onclick="$.saveResendEmails()">' . trans('booking::pulsar.save_resend') . '</a>';

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        $oldVouchers        = collect(json_decode($this->request->input('oldVouchers')));
        $vouchersProperties = $this->getVouchersProperties();

        Booking::where('id_225', $parameters['id'])->update([
            'status_225'                    => $this->request->input('status'),
            'status_text_225'               => trans(collect(config('booking.status'))->where('id', $this->request->input('status'))->first()->name),

            'customer_id_225'               => $this->request->input('customerId'),
            'customer_name_225'             => $this->request->input('customer'),
            'customer_observations_225'     => $this->request->has('customerObservations')? $this->request->input('customerObservations') : null,

            'place_id_225'                  => $this->request->input('place'),
            'object_id_225'                 => $this->request->input('object'),
            'object_name_225'               => $this->request->input('objectName'),
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

            'vouchers_paid_amount_225'      => $vouchersProperties['vouchersPaidAmount'],
            'vouchers_cost_amount_225'      => $vouchersProperties['vouchersCostAmount'],
            'direct_payment_amount_225'     => $this->request->has('directPaymenAmount')? $this->request->input('directPaymenAmount') : 0,
            'total_amount_225'              => $this->request->input('totalAmount'),
            'tax_percentage_225'            => $this->request->input('taxPercentage'),

            'commission_percentage_225'     => $this->request->input('commissionPercentage'),
            'commission_calculation_225'    => $this->request->input('commissionCalculation'),
            'commission_amount_225'         => $this->request->input('commissionAmount'),

            'observations_225'              => $this->request->has('observations')? $this->request->input('observations') : null,

            'data_225'                      => json_encode($vouchersProperties['vouchersId'])
        ]);

        $booking = Booking::builder()->where('id_225', $parameters['id'])->first();

        $vouchersToReset = $oldVouchers->diff($vouchersProperties['vouchersId']);

        $this->setVouchersToReset($vouchersToReset);

        // cancel booking
        if($booking->status_225 === 3)
        {
            $this->setVouchersToReset($vouchersProperties['vouchersId']);
        }
        // register new vouchers
        else
        {
            $this->setVouchersToRegister($vouchersProperties['vouchersId'], $booking);
        }

        if($this->request->input('resendEmails') === '1')
        {
            $this->sendEmails($booking);
        }
    }

    public function showCustomRecord($parameters)
    {
        if(isset($parameters['resendEmails']) && $parameters['resendEmails'] === '1')
        {
            $this->sendEmails($parameters['object']);
            return redirect()->route('bookingBooking', ['offset' => $parameters['offset']]);
        }

        $parameters = $this->commonCustomRecord($parameters);

        // objects from place
        if(isset($parameters['object']->place_id_225))
        {
            $result = collect(config('booking.models'))->where('id', $parameters['object']->place_id_225);

            if (count($result) === 0)
                return response()->json([
                    'status'    => 'error',
                    'code'      => 404,
                    'message'   => 'Records not found'
                ]);

            // model constructor
            $model                      = App::make($result->first()->model);

            // use sofa to get lang from lang table of object query
            $parameters['objects']      = $model->builder()->where('lang_id', base_lang()->id_001)->get();
            $parameters['objectName']   = trans_choice($result->first()->name, 1);
            $parameters['objectKey']    = $model->getKeyName();
        }

        $parameters['vouchers']         = Voucher::builder()->whereIn('id_226', json_decode($parameters['object']->data_225))->get();

        $parameters['afterButtonFooter'] = '<a class="btn btn-info margin-l10" onclick="$.resendEmails()">' . trans('booking::pulsar.resend') . '</a>';

        return $parameters;
    }

    private function getVouchersProperties()
    {
        $vouchersPaidAmount = 0;
        $vouchersCostAmount = 0;
        if($this->request->has('vouchers'))
        {
            $vouchers = collect($this->request->input('vouchers'));
            $vouchers->transform(function ($item, $key) {
                return (int)$item;
            });

            foreach ($vouchers as $voucher)
            {
                $vouchersPaidAmount += (float)$this->request->input('voucherPaid-' . $voucher);
                $vouchersCostAmount += (float)$this->request->input('voucherCost-' . $voucher);
            }
        }
        else
        {
            // if there aren't vouchers, create empty vouchers
            $vouchers = collect();
        }

        return [
            'vouchersPaidAmount'    => $vouchersPaidAmount,
            'vouchersCostAmount'    => $vouchersCostAmount,
            'vouchersId'            => $vouchers
        ];
    }

    private function setVouchersToRegister($vouchers, $booking)
    {
        foreach ($vouchers as $voucher)
        {
            Voucher::where('id_226', $voucher)->update([
                'has_used_226'          => true,
                'used_date_226'         => $booking->check_in_date_225,
                'used_date_text_226'    => $booking->check_in_date_text_225,
                'booking_id_226'        => $booking->id_225,
                'place_id_226'          => $booking->place_id_225,
                'object_id_226'         => $booking->object_id_225,
                'cost_226'              => (float)$this->request->input('voucherCost-' . $voucher)
            ]);
        }
    }

    private function setVouchersToReset($vouchers)
    {
        if($vouchers->count() > 0)
        {
            Voucher::whereIn('id_226', $vouchers)->update([
                'has_used_226'          => false,
                'used_date_226'         => null,
                'used_date_text_226'    => null,
                'booking_id_226'        => null,
                'place_id_226'          => null,
                'object_id_226'         => null,
                'cost_226'              => null
            ]);
        }
    }

    private function sendEmails(Booking $booking)
    {
        // objects from place
        if(isset($booking->place_id_225))
        {
            $result = collect(config('booking.models'))->where('id', $booking->place_id_225);

            if (count($result) === 0)
            {
                return response()->json([
                    'status'    => 'error',
                    'code'      => 404,
                    'message'   => 'Records not found'
                ]);
            }

            // model constructor
            $model              = App::make($result->first()->model);

            // use sofa to get lang from lang table of object query
            $establishment      = $model->builder()->where('lang_id', base_lang()->id_001)->where('id', $booking->object_id_225)->first();

            $attachment = Attachment::builder()
                ->where('lang_id_016', base_lang()->id_001)
                ->where('resource_id_016', 'hotels-hotel')
                ->where('object_id_016', $establishment->id)
                ->where('family_id_016', 1) // config('ruralka.idAttachmentsFamily.hotelSheet')
                ->orderBy('sorting', 'asc')
                ->first();

            //****************************
            // get values to Master Card
            //****************************
            $customFields = CustomField::where('group_id_026', 4)->get();

            if(isset($customFields) && $customFields->where('name_026', 'master_card_feature')->count() > 0)
            {
                $masterCardFeatures = $customFields->where('name_026', 'master_card_feature')
                    ->first()
                    ->getResults()
                    ->where('object_id_028', $establishment->id_170)
                    ->where('lang_id_028', 'es')
                    ->get()
                    ->first();
            }
            else
            {
                $masterCardFeatures         = null;
            }

            // get vouchers
            $vouchers                       = Voucher::builder()->whereIn('id_226', json_decode($booking->data_225))->get();

            // status confirmed
            if($booking->status_225 == 1)
            {
                Mail::to('cpalacin@syscover.com')
                    ->bcc('info@syscover.com')
                    //->cc('cristina@ruralka.com')
                    ->send(new BookingEmail(
                        'booking::emails.customer_booking_notification',
                        trans('booking::pulsar.subject_customer_booking_email', ['bookingId' => $booking->id_225 . '/' . date('Y')]),
                        $booking,
                        $establishment,
                        $vouchers,
                        $attachment,
                        $masterCardFeatures
                    ));

                Mail::to('cpalacin@syscover.com')
                    ->bcc('info@syscover.com')
                    //->cc('cristina@ruralka.com')
                    ->send(new BookingEmail(
                        'booking::emails.hotel_booking_notification',
                        trans('booking::pulsar.subject_hotel_booking_email', ['bookingId' => $booking->id_225 . '/' . date('Y')]),
                        $booking,
                        $establishment,
                        $vouchers,
                        $attachment,
                        $masterCardFeatures
                    ));
            }
            // status cancel
            elseif ($booking->status_225 == 3)
            {
                Mail::to('cpalacin@syscover.com')
                    ->bcc('info@syscover.com')
                    //->cc('cristina@ruralka.com')
                    ->send(new BookingEmail(
                        'booking::emails.customer_cancel_booking_notification',
                        trans('booking::pulsar.subject_customer_cancel_booking_email', ['bookingId' => $booking->id_225 . '/' . date('Y')]),
                        $booking,
                        $establishment,
                        $vouchers,
                        $attachment,
                        $masterCardFeatures
                    ));

                Mail::to('cpalacin@syscover.com')
                    ->bcc('info@syscover.com')
                    //->cc('cristina@ruralka.com')
                    ->send(new BookingEmail(
                        'booking::emails.hotel_cancel_booking_notification',
                        trans('booking::pulsar.subject_hotel_cancel_booking_email', ['bookingId' => $booking->id_225 . '/' . date('Y')]),
                        $booking,
                        $establishment,
                        $vouchers,
                        $attachment,
                        $masterCardFeatures
                    ));
            }
        }
    }
}