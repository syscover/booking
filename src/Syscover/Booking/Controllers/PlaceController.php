<?php namespace Syscover\Booking\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\Place;

/**
 * Class PlaceController
 * @package Syscover\Booking\Controllers
 */

class PlaceController extends Controller
{
    protected $routeSuffix  = 'bookingPlace';
    protected $folder       = 'place';
    protected $package      = 'booking';
    protected $aColumns     = ['id_220', 'name_220'];
    protected $nameM        = 'name_220';
    protected $model        = Place::class;
    protected $icon         = 'fa fa-map-marker';
    protected $objectTrans  = 'place';

    public function createCustomRecord($parameters)
    {
        $parameters['models']      = array_map(function($object){
            $object->name = trans_choice($object->name, 1);
            return $object;
        }, config('booking.models'));

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        Place::create([
            'name_220'  => $this->request->input('name'),
            'model_220' => $this->request->input('model')
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['models']      = array_map(function($object){
            $object->name = trans_choice($object->name, 1);
            return $object;
        }, config('booking.models'));

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        Place::where('id_220', $parameters['id'])->update([
            'name_220'  => $this->request->input('name'),
            'model_220' => $this->request->input('model')
        ]);
    }
}