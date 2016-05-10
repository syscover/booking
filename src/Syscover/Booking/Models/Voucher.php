<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Voucher
 *
 * Model with properties
 * <br><b>[id, date, data_text, campaign_id, code, product_id, name, description, customer_id, invoice, price, cost, expire_date, expire_date_text, used_date, used_date_text, place_id_223, object_id_223, active]</b>
 *
 * @package     Syscover\Crm\Models
 */

class Voucher extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_222_voucher';
    protected $primaryKey   = 'id_222';
    protected $suffix       = '222';
    public $timestamps      = false;
    protected $fillable     = ['id_222', 'date_222', 'data_text_222', 'campaign_id_222', 'code_222', 'product_id_222', 'name_222', 'description_222', 'customer_id_222', 'invoice_222', 'price_222', 'cost_222', 'expire_date_222', 'expire_date_text_222', 'used_date_222', 'used_date_text_222', 'place_id_223', 'object_id_223', 'active_222'];
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
        return $query;
    }
}