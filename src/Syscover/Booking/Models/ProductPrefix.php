<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductPrefix
 *
 * Model with properties
 * <br><b>[product_id, prefix]</b>
 *
 * @package     Syscover\Booking\Models
 */

class ProductPrefix extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_222_product_prefix';
    protected $primaryKey   = 'product_id_222';
    protected $suffix       = '222';
    public $timestamps      = false;
    protected $fillable     = ['product_id_222', 'prefix_222'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'prefix' => 'required|between:2,255'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('012_111_product', '011_222_product_prefix.product_id_222', '=', '012_111_product.id_111')
            ->join('012_112_product_lang', '012_111_product.id_111', '=', '012_112_product_lang.id_112')
            ->join('001_001_lang', '012_112_product_lang.lang_id_112', '=', '001_001_lang.id_001')
            ->where('012_112_product_lang.lang_id_112', base_lang()->id_001);
    }
}