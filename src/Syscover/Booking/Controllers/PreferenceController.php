<?php namespace Syscover\Booking\Controllers;

use Syscover\Pulsar\Core\Controller;
use Illuminate\Http\Request;
use Syscover\Pulsar\Models\Preference;

/**
 * Class PreferenceController
 * @package Syscover\Booking\Controllers
 */

class PreferenceController extends Controller
{
    protected $routeSuffix  = 'bookingPreference';
    protected $folder       = 'preference';
    protected $package      = 'booking';
    protected $model        = Preference::class;
    protected $icon         = 'icon-cog';
    protected $objectTrans  = 'preference';

    function __construct(Request $request)
    {
        parent::__construct($request);

        $this->viewParameters['cancelButton'] = false;
    }

    public function customIndex($parameters)
    {
        $parameters['nVouchersToCreate'] = Preference::getValue('bookingNVouchersToCreate', 11);

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Preference::setValue('bookingNVouchersToCreate', 11, $this->request->input('nVouchersToCreate'));
    }
}