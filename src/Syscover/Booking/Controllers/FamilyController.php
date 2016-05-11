<?php namespace Syscover\Booking\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\Family;

/**
 * Class FamilyController
 * @package Syscover\Booking\Controllers
 */

class FamilyController extends Controller
{
    protected $routeSuffix  = 'bookingFamily';
    protected $folder       = 'family';
    protected $package      = 'booking';
    protected $aColumns     = ['id_223', 'name_223', 'mail_template_223'];
    protected $nameM        = 'name_223';
    protected $model        = Family::class;
    protected $icon         = 'fa fa-align-justify';
    protected $objectTrans  = 'family';

    public function storeCustomRecord($parameters)
    {
        Family::create([
            'name_223'          => $this->request->input('name'),
            'mail_template_223' => $this->request->input('mailTemplate')
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Family::where('id_223', $parameters['id'])->update([
            'name_223'          => $this->request->input('name'),
            'mail_template_223' => $this->request->input('mailTemplate')
        ]);
    }
}