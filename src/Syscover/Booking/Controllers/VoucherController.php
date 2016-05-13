<?php namespace Syscover\Booking\Controllers;

use Syscover\Booking\Models\Campaign;
use Syscover\Booking\Models\ProductPrefix;
use Syscover\Pulsar\Core\Controller;
use Syscover\Booking\Models\Voucher;
use Syscover\Market\Models\Product;

/**
 * Class VoucherController
 * @package Syscover\Crm\Controllers
 */

class VoucherController extends Controller
{
    protected $routeSuffix  = 'bookingVoucher';
    protected $folder       = 'voucher';
    protected $package      = 'booking';
    protected $aColumns     = ['id_226', 'code_226'];
    protected $nameM        = 'name_226';
    protected $model        = Voucher::class;
    protected $icon         = 'fa fa-sort-alpha-asc';
    protected $objectTrans  = 'voucher';

    public function createCustomRecord($parameters)
    {
        $parameters['campaigns']    = Campaign::builder()->where('active_221', true)->get();
        $parameters['products']     = Product::builder()->where('lang_112', base_lang()->id_001)->get();
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
        $customer = Customer::create([
            'lang_301'                  => $this->request->input('lang'),
            'group_301'                 => $this->request->input('group'),
            'date_301'                  => $this->request->has('date')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('date'))->getTimestamp() : null,
            'company_301'               => empty($this->request->input('company'))? null : $this->request->input('company'),
            'tin_301'                   => empty($this->request->input('tin'))? null : $this->request->input('tin'),
            'gender_301'                => $this->request->has('gender')? $this->request->input('gender') : null,
            'treatment_301'             => $this->request->has('treatment')? $this->request->input('treatment') : null,
            'state_301'                 => $this->request->has('state')? $this->request->input('state') : null,
            'name_301'                  => empty($this->request->input('name'))? null : $this->request->input('name'),
            'surname_301'               => empty($this->request->input('surname'))? null : $this->request->input('surname'),
            'avatar_301'                => empty($this->request->input('avatar'))? null : $this->request->input('avatar'),
            'birth_date_301'            => $this->request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('birthDate'))->getTimestamp() : null,
            'email_301'                 => $this->request->input('email'),
            'phone_301'                 => empty($this->request->input('phone'))? null : $this->request->input('phone'),
            'mobile_301'                => empty($this->request->input('mobile'))? null : $this->request->input('mobile'),
            'user_301'                  => $this->request->input('user'),
            'password_301'              => Hash::make($this->request->input('password')),
            'active_301'                => $this->request->has('active'),
            'confirmed_301'             => false,
            'country_301'               => $this->request->has('country')? $this->request->input('country') : null,
            'territorial_area_1_301'    => $this->request->has('territorialArea1')? $this->request->input('territorialArea1') : null,
            'territorial_area_2_301'    => $this->request->has('territorialArea2')? $this->request->input('territorialArea2') : null,
            'territorial_area_3_301'    => $this->request->has('territorialArea3')? $this->request->input('territorialArea3') : null,
            'cp_301'                    => empty($this->request->input('cp'))? null : $this->request->input('cp'),
            'locality_301'              => empty($this->request->input('locality'))? null : $this->request->input('locality'),
            'address_301'               => empty($this->request->input('address'))? null : $this->request->input('address'),
            'latitude_301'              => empty($this->request->input('latitude'))? null : $this->request->input('latitude'),
            'longitude_301'             => empty($this->request->input('longitude'))? null : $this->request->input('longitude'),
        ]);

        // set attachments
        $attachments = json_decode($this->request->input('attachments'));
        AttachmentLibrary::storeAttachments($attachments, 'crm', 'crm-customer', $customer->id_301, base_lang()->id_001);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['langs']        = Lang::all();

        $parameters['groups']       = Group::all();

        $parameters['genres']       = array_map(function($object){
            $object->name = trans($object->name);
            return $object;
        }, config('pulsar.genres'));

        $parameters['treatments']   = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('pulsar.treatments'));

        $parameters['states']       = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('pulsar.states'));

        // get attachments elements
        $attachments = AttachmentLibrary::getRecords('crm', 'crm-customer', $parameters['object']->id_301, base_lang()->id_001);

        // merge parameters and attachments array
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_015' => 'cms-article']);
        $parameters                         = array_merge($parameters, $attachments);

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        $customer = [
            'lang_301'                  => $this->request->input('lang'),
            'group_301'                 => $this->request->input('group'),
            'date_301'                  => $this->request->has('date')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('date'))->getTimestamp() : null,
            'company_301'               => empty($this->request->input('company'))? null : $this->request->input('company'),
            'tin_301'                   => empty($this->request->input('tin'))? null : $this->request->input('tin'),
            'gender_301'                => $this->request->has('gender')? $this->request->input('gender') : null,
            'treatment_301'             => $this->request->has('treatment')? $this->request->input('treatment') : null,
            'state_301'                 => $this->request->has('state')? $this->request->input('state') : null,
            'name_301'                  => empty($this->request->input('name'))? null : $this->request->input('name'),
            'surname_301'               => empty($this->request->input('surname'))? null : $this->request->input('surname'),
            'avatar_301'                => empty($this->request->input('avatar'))? null : $this->request->input('avatar'),
            'birth_date_301'            => $this->request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('birthDate'))->getTimestamp() : null,
            'phone_301'                 => empty($this->request->input('phone'))? null : $this->request->input('phone'),
            'mobile_301'                => empty($this->request->input('phone'))? null : $this->request->input('mobile'),
            'active_301'                => $this->request->has('active'),
            'country_301'               => $this->request->has('country')? $this->request->input('country') : null,
            'territorial_area_1_301'    => $this->request->has('territorialArea1')? $this->request->input('territorialArea1') : null,
            'territorial_area_2_301'    => $this->request->has('territorialArea2')? $this->request->input('territorialArea2') : null,
            'territorial_area_3_301'    => $this->request->has('territorialArea3')? $this->request->input('territorialArea3') : null,
            'cp_301'                    => empty($this->request->input('cp'))? null : $this->request->input('cp'),
            'locality_301'              => empty($this->request->input('locality'))? null : $this->request->input('locality'),
            'address_301'               => empty($this->request->input('address'))? null : $this->request->input('address'),
            'latitude_301'              => empty($this->request->input('latitude'))? null : $this->request->input('latitude'),
            'longitude_301'             => empty($this->request->input('longitude'))? null : $this->request->input('longitude'),
        ];

        if($parameters['specialRules']['emailRule'])  $customer['email_301']      = $this->request->input('email');
        if($parameters['specialRules']['userRule'])   $customer['user_301']       = $this->request->input('user');
        if(! $parameters['specialRules']['passRule']) $customer['password_301']   = Hash::make($this->request->input('password'));

        Customer::where('id_301', $parameters['id'])->update($customer);
    }
}