<?php namespace Syscover\Booking\Controllers;

use Syscover\Booking\Models\VoucherTask;
use Syscover\Pulsar\Core\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Syscover\Pulsar\Libraries\Miscellaneous;
use Syscover\Facturadirecta\Libraries\Facturadirecta;
use Syscover\Booking\Models\Campaign;
use Syscover\Booking\Models\Place;
use Syscover\Booking\Models\ProductPrefix;
use Syscover\Booking\Models\Voucher;
use Syscover\Market\Models\Product;

/**
 * Class VoucherController
 * @package Syscover\Booking\Controllers
 */

class VoucherController extends Controller
{
    protected $routeSuffix  = 'bookingVoucher';
    protected $folder       = 'voucher';
    protected $package      = 'booking';
    protected $aColumns     = ['id_226', 'code_prefix_226', 'name_221', 'name_226', 'price_226', ['data' => 'paid_226', 'type' => 'active'], 'cost_226'];
    protected $nameM        = 'name_226';
    protected $model        = Voucher::class;
    protected $icon         = 'fa fa-sort-alpha-asc';
    protected $objectTrans  = 'voucher';

    public function createCustomRecord($parameters)
    {
        $parameters['campaigns']    = Campaign::builder()->where('active_221', true)->get();
        $parameters['products']     = Product::builder()->where('lang_112', base_lang()->id_001)->get();
        $parameters['places']       = Place::builder()->get();
        $productPrefixes            = ProductPrefix::all();

        $parameters['products']->map(function($item, $key) use ($productPrefixes) {
            // set prefix products
            $productPrefix = $productPrefixes->where('product_id_222', $item->id_111)->first();
            if($productPrefix == null)
                return $item->prefix_222 = null;
            return $item->prefix_222 = $productPrefixes->where('product_id_222', $item->id_111)->first()->prefix_222;
        });

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        $voucher = Voucher::create([
            'date_226'                  => date('U'),
            'date_text_226'             => date(config('pulsar.datePattern')),
            'code_prefix_226'           => $this->request->has('codePrefix')? $this->request->input('codePrefix') : null,
            'campaign_id_226'           => $this->request->input('campaign'),
            'customer_id_226'           => $this->request->input('customerId'),
            'customer_name_226'         => $this->request->input('customer'),
            'bearer_226'                => $this->request->has('bearer')? $this->request->input('bearer') : null,
            'invoice_id_226'            => $this->request->has('invoiceId')? $this->request->input('invoiceId') : null,
            'invoice_code_226'          => $this->request->has('invoiceCode')? $this->request->input('invoiceCode') : null,
            'invoice_customer_id_226'   => $this->request->has('invoiceCustomerId')? $this->request->input('invoiceCustomerId') : null,
            'invoice_customer_name_226' => $this->request->has('invoiceCustomerName')? $this->request->input('invoiceCustomerName') : null,
            'product_id_226'            => $this->request->input('product'),
            'name_226'                  => $this->request->has('name')? $this->request->input('name') : null,
            'description_226'           => $this->request->has('description')? $this->request->input('description') : null,
            'price_226'                 => $this->request->input('price'),
            'expire_date_226'           => $this->request->has('expireDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('expireDate'))->getTimestamp() : null,
            'expire_date_text_226'      => $this->request->has('expireDate')?  $this->request->input('expireDate') : null,
            'active_226'                => $this->request->has('active'),
        ]);

        if($this->request->has('bulkCreate') && (int)$this->request->input('bulkCreate') -1 > 0)
        {
            // create task to create vouchers
            VoucherTask::create([
                'voucher_id_227'            => $voucher->id_226,
                'vouchers_to_create_227'    => (int)$this->request->input('bulkCreate') -1
            ]);
        }
    }

    public function editCustomRecord($parameters)
    {
        $parameters['campaigns']    = Campaign::builder()->where('active_221', true)->get();
        $parameters['products']     = Product::builder()->where('lang_112', base_lang()->id_001)->get();
        $parameters['places']       = Place::builder()->get();
        $productPrefixes            = ProductPrefix::all();

        $parameters['products']->map(function($item, $key) use ($productPrefixes) {
            // set prefix products
            $productPrefix = $productPrefixes->where('product_id_222', $item->id_111)->first();
            if($productPrefix == null)
                return $item->prefix_222 = null;
            return $item->prefix_222 = $productPrefixes->where('product_id_222', $item->id_111)->first()->prefix_222;
        });
        
        $response   = Facturadirecta::getInvoice($parameters['object']->invoice_id_226);
        $collection = collect();

        // check that response does not contain httpStatus 404
        if(! isset($response['httpStatus']))
        {
            // set id like integer, to compare in select
            $response['id']             = (int) $response['id'];
            $parameters['invoices']     = $collection->push(Miscellaneous::arrayToObject($response));
        }

        // objects from place
        if(isset($parameters['object']->place_id_226))
        {
            $result = collect(config('booking.models'))->where('id', $parameters['object']->place_id_226);

            if (count($result) === 0)
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Records not found'
                ]);

            // model constructor
            $model                      = App::make($result->first()->model);
            // use sofa to get lang from lang table of object query
            $parameters['objects']      = $model->builder()->where('lang_id', base_lang()->id_001)->get();
            $parameters['objectName']   = trans_choice($result->first()->name, 1);
        }

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        Voucher::where('id_226', $parameters['id'])->update([
            'code_prefix_226'               => $this->request->has('codePrefix')? $this->request->input('codePrefix') : null,
            'campaign_id_226'               => $this->request->input('campaign'),
            'customer_id_226'               => $this->request->input('customerId'),
            'customer_name_226'             => $this->request->input('customer'),
            'bearer_226'                    => $this->request->has('bearer')? $this->request->input('bearer') : null,
            'invoice_id_226'                => $this->request->has('invoiceId')? $this->request->input('invoiceId') : null,
            'invoice_code_226'              => $this->request->has('invoiceCode')? $this->request->input('invoiceCode') : null,
            'invoice_customer_id_226'       => $this->request->has('invoiceCustomerId')? $this->request->input('invoiceCustomerId') : null,
            'invoice_customer_name_226'     => $this->request->has('invoiceCustomerName')? $this->request->input('invoiceCustomerName') : null,
            'product_id_226'                => $this->request->input('product'),
            'name_226'                      => $this->request->has('name')? $this->request->input('name') : null,
            'description_226'               => $this->request->has('description')? $this->request->input('description') : null,
            'price_226'                     => $this->request->input('price'),
            'expire_date_226'               => $this->request->has('expireDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('expireDate'))->getTimestamp() : null,
            'expire_date_text_226'          => $this->request->has('expireDate')?  $this->request->input('expireDate') : null,
            'active_226'                    => $this->request->has('active'),
            'used_date_226'                 => $this->request->has('usedDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('usedDate'))->getTimestamp() : null,
            'used_date_text_226'            => $this->request->has('usedDate')?  $this->request->input('usedDate') : null,
            'place_id_226'                  => $this->request->has('place')?  $this->request->input('place') : null,
            'object_id_226'                 => $this->request->has('object')?  $this->request->input('object') : null,
            'cost_226'                      => $this->request->has('cost')? $this->request->input('cost') : null,
            'paid_226'                      => $this->request->has('payoutDate'),
            'place_payout_date_226'         => $this->request->has('payoutDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('payoutDate'))->getTimestamp() : null,
            'place_payout_date_text_226'    => $this->request->has('payoutDate')?  $this->request->input('payoutDate') : null,
        ]);
    }

    public function getDataObjects(Request $request)
    {
        $parameters = $request->route()->parameters();

        $result = collect(config('booking.models'))->where('id', (int) $parameters['model']);

        if(count($result) === 0)
            return response()->json([
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Records not found'
            ]);

        // model constructor
        $model          = App::make($result->first()->model);
        $name           = trans_choice($result->first()->name, 1);
        $primaryKey     = $model->getKeyName();
        $suffix         = $model->getSuffix();
        // use sofa to get lang from lang table of object query
        $objects        = $model->builder()->where('lang_id', base_lang()->id_001)->get();

        return response()->json([
            'status'        => 'success',
            'name'          => $name,
            'primaryKey'    => $primaryKey,
            'suffix'        => $suffix,
            'objects'       => $objects,
        ]);
    }
}