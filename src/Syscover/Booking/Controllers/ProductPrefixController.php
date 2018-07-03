<?php namespace Syscover\Booking\Controllers;

use Syscover\Market\Old\Models\Product;
use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\ProductPrefix;

/**
 * Class ProductPrefixController
 * @package Syscover\Booking\Controllers
 */

class ProductPrefixController extends Controller
{
    protected $routeSuffix  = 'bookingProductPrefix';
    protected $folder       = 'product_prefix';
    protected $package      = 'booking';
    protected $indexColumns = ['product_id_222', 'name_112', 'prefix_222'];
    protected $nameM        = 'name_221';
    protected $model        = ProductPrefix::class;
    protected $icon         = 'fa fa-barcode';
    protected $objectTrans  = 'product_prefix';

    public function createCustomRecord($parameters)
    {
        $productRecords = ProductPrefix::builder()->get(['product_id_222']);
        
        $parameters['products'] = Product::builder()
            ->where('lang_id_112', base_lang2()->id_001)
            ->whereNotIn('id_111', $productRecords)
            ->get();
        
        return $parameters;
    }
    
    public function storeCustomRecord($parameters)
    {
        ProductPrefix::create([
            'product_id_222'    => $this->request->input('product'),
            'prefix_222'        => $this->request->input('prefix')
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['products'] = Product::builder()
            ->where('lang_id_112', base_lang2()->id_001)
            ->get();

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        ProductPrefix::where('product_id_222', $parameters['id'])->update([
            'prefix_222'        => $this->request->input('prefix')
        ]);
    }
}