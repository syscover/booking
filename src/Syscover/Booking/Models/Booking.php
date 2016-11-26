<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Booking
 *
 * Model with properties
 * <br><b>[id, date, date_text, status, status_text, customer_id, customer_name, customer_observations, place_id, object_id, object_name, object_description, place_observations, check_in_date, check_in_date_text, check_out_date, check_out_date_text, nights, n_adults, n_children, n_rooms, temporary_beds, breakfast, vouchers_paid_amount, vouchers_cost_amount, direct_payment_amount, total_amount, tax_percentage, commission_percentage, commission_calculation, commission_amount, observations, data]</b>
 *
 * @package     Syscover\Crm\Models
 */

class Booking extends Model
{
    use Eloquence, Mappable;

	protected  $table        = '011_225_booking';
    protected $primaryKey   = 'id_225';
    protected $suffix       = '225';
    public $timestamps      = false;
    protected $fillable     = ['id_225', 'date_225', 'date_text_225', 'status_225', 'status_text_225', 'customer_id_225', 'customer_name_225', 'customer_observations_225', 'place_id_225', 'object_id_225', 'object_name_225', 'object_description_225', 'place_observations_225', 'check_in_date_225', 'check_in_date_text_225', 'check_out_date_225', 'check_out_date_text_225', 'nights_225', 'n_adults_225', 'n_children_225', 'n_rooms_225', 'temporary_beds_225', 'breakfast_225', 'vouchers_paid_amount_225', 'vouchers_cost_amount_225', 'direct_payment_amount_225', 'total_amount_225', 'tax_percentage_225', 'commission_percentage_225', 'commission_calculation_225', 'commission_amount_225', 'observations_225', 'data_225'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'status'        => 'required',
        'customerId'    => 'required',
        'place'         => 'required',
        'object'        => 'required',
        'taxPercentage' => 'required'
    ];
    protected $casts = [
        'tax_percentage_225' => 'float',
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('009_301_customer', '011_225_booking.customer_id_225', '=', '009_301_customer.id_301');
    }
}