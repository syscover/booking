<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Family
 *
 * Model with properties
 * <br><b>[id, name, model]</b>
 *
 * @package     Syscover\Booking\Models
 */

class Family extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_223_family';
    protected $primaryKey   = 'id_223';
    protected $suffix       = '223';
    public $timestamps      = false;
    protected $fillable     = ['id_223', 'name_223', 'mail_template_223'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'name'          => 'required|between:2,255',
        'mailTemplate'  => 'required|between:2,255'
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