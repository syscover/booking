<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Campaign
 *
 * Model with properties
 * <br><b>[id, name, prefix, active]</b>
 *
 * @package     Syscover\Booking\Models
 */

class Campaign extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_221_campaign';
    protected $primaryKey   = 'id_221';
    protected $suffix       = '221';
    public $timestamps      = false;
    protected $fillable     = ['id_221', 'name_221', 'prefix_221', 'active_221'];
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