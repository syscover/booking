<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class VoucherTask
 *
 * Model with properties
 * <br><b>[id, user_id, voucher_id, vouchers_to_create, total_vouchers]</b>
 *
 * @package     Syscover\Booking\Models
 */

class VoucherTask extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_227_voucher_task';
    protected $primaryKey   = 'id_227';
    protected $suffix       = '227';
    public $timestamps      = false;
    protected $fillable     = ['id_227', 'user_id_227','voucher_id_227', 'vouchers_to_create_227', 'total_vouchers_227'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('011_226_voucher', '011_227_voucher_task.voucher_id_227', '=', '011_226_voucher.id_226');
    }
    
    public function getVoucher()
    {
        return $this->belongsTo('Syscover\Booking\Models\Voucher', 'voucher_id_227');
    }

    public function getUser()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\User', 'user_id_227');
    }
}