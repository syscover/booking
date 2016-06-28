<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Place
 *
 * Model with properties
 * <br><b>[id, name, model_id]</b>
 *
 * @package     Syscover\Booking\Models
 */

class Place extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_220_place';
    protected $primaryKey   = 'id_220';
    protected $suffix       = '220';
    public $timestamps      = false;
    protected $fillable     = ['id_220', 'name_220', 'model_id_220'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'name'      => 'required|between:2,255',
        'model'     => 'required'
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