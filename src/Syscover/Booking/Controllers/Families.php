<?php namespace Syscover\Booking\Controllers;

/**
 * @package	    Pulsar
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Booking\Models\Family;

class Families extends Controller {

    use TraitController;

    protected $routeSuffix  = 'BookingFamily';
    protected $folder       = 'families';
    protected $package      = 'booking';
    protected $aColumns     = ['id_220', 'name_220'];
    protected $nameM        = 'name_220';
    protected $model        = '\Syscover\Booking\Models\Family';
    protected $icon         = 'icomoon-icon-power';
    protected $objectTrans  = 'family';

    public function storeCustomRecord($parameters)
    {
        Family::create([
            'id_220'    => $this->request->input('id'),
            'name_220'  => $this->request->input('name')
        ]);
    }
    
    public function updateCustomRecord($parameters)
    {
        Family::where('id_220', $parameters['id'])->update([
            'name_220'  => $this->request->input('name')
        ]);
    }
}