<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Booking
 *
 * Model with properties
 * <br><b>[id, date, data_text, status, customer_id, place_id, object_id, room_description, check_in_date, check_in_date_text, check_out_date, check_out_date_text, n_adult, n_children, temporary_bed, breakfast, vouchers_cost_amount, customer_place_amount, total_amount, commission_percentage, amount_on_commission, commission_amount, observations, place_observations, customer_observations]</b>
 *
 * @package     Syscover\Crm\Models
 */

class Booking extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_225_booking';
    protected $primaryKey   = 'id_225';
    protected $suffix       = '225';
    public $timestamps      = false;
    protected $fillable     = ['id_225', 'date_225', 'data_text_225', 'status_225', 'customer_id_225', 'place_id_225', 'object_id_225', 'room_description_225', 'check_in_date_225', 'check_in_date_text_225', 'check_out_date_225', 'check_out_date_text_225', 'n_adult_225', 'n_children_225', 'temporary_bed_225', 'breakfast_225', 'vouchers_cost_amount_225', 'customer_place_amount_225', 'total_amount_225', 'commission_percentage_225', 'amount_on_commission_225', 'commission_amount_225', 'observations_225', 'place_observations_225', 'customer_observations_225'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [

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