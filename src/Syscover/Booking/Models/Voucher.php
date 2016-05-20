<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Voucher
 *
 * Model with properties
 * <br><b>[id, code_prefix, booking_id, date, data_text, campaign_id, customer_id, bearer, place_id, object_id, invoice, product_id, name, description, price, cost, paid, place_payout_date_225, place_payout_date_text_225, expire_date, expire_date_text, used_date, used_date_text, active]</b>
 *
 * @package     Syscover\Booking\Models
 */

class Voucher extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_226_voucher';
    protected $primaryKey   = 'id_226';
    protected $suffix       = '226';
    public $timestamps      = false;
    protected $fillable     = ['id_226', 'code_prefix_226', 'booking_id_226', 'date_226', 'date_text_226', 'campaign_id_226', 'customer_id_226', 'customer_name_226', 'bearer_226', 'place_id_226', 'object_id_226', 'invoice_id_226', 'invoice_code_226', 'invoice_customer_id_226', 'invoice_customer_name_226', 'product_id_226', 'name_226', 'description_226', 'price_226', 'cost_226', 'paid_226', 'place_payout_date_225', 'place_payout_date_text_225', 'expire_date_226', 'expire_date_text_226', 'used_date_226', 'used_date_text_226', 'active_226'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'name'      => 'required|between:2,255'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('011_221_campaign', '011_226_voucher.campaign_id_226', '=', '011_221_campaign.id_221');
    }
}