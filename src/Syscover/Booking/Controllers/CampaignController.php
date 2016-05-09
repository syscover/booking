<?php namespace Syscover\Booking\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\Campaign;

/**
 * Class CampaignController
 * @package Syscover\Booking\Controllers
 */

class CampaignController extends Controller
{
    protected $routeSuffix  = 'bookingCampaign';
    protected $folder       = 'campaign';
    protected $package      = 'booking';
    protected $aColumns     = ['id_221', 'name_221', ['data' => 'active_221', 'type' => 'active']];
    protected $nameM        = 'name_221';
    protected $model        = Campaign::class;
    protected $icon         = 'fa fa-bookmark';
    protected $objectTrans  = 'campaign';
    
    public function storeCustomRecord($parameters)
    {
        Campaign::create([
            'name_221'      => $this->request->input('name'),
            'active_221'    => $this->request->has('active')
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Campaign::where('id_221', $parameters['id'])->update([
            'name_221'      => $this->request->input('name'),
            'active_221'    => $this->request->has('active')
        ]);
    }
}