<?php namespace Syscover\Booking\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Voucher
 *
 * Model with properties
 * <br><b>[id, code, date, data_text, customer, product, name, description, cost, price, used_date, used_date_text, expire_date, expire_date_text, active]</b>
 *
 * @package     Syscover\Crm\Models
 */

class Voucher extends Model
{
    use Eloquence, Mappable;

	protected $table        = '011_220_voucher';
    protected $primaryKey   = 'id_220';
    protected $suffix       = '220';
    public $timestamps      = false;
    protected $fillable     = ['id_220', 'code_220', 'date_220', 'data_text_220', 'customer_220', 'product_220', 'name_220', 'description_220', 'cost_220', 'price_220', 'used_date_220', 'used_date_text_220', 'expire_date_220', 'expire_date_text_220', 'active_220'];
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

    /**
     * Get Lang from user
     *
     * @return \Syscover\Pulsar\Models\Lang
     */
    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_355');
    }

    /**
     * Get group from user
     *
     * @return \Syscover\Crm\Models\Group
     */
    public function getGroup()
    {
        return $this->belongsTo(Group::class, 'group_301');
    }

    /**
     * Get attachments from customer
     *
     * @return mixed
     */
    public function getAttachments()
    {
        return $this->hasMany('Syscover\Pulsar\Models\Attachment', 'object_016')
            ->where('001_016_attachment.lang_016', base_lang()->id_001)
            ->where('001_016_attachment.resource_016', 'crm-customer')
            ->leftJoin('001_015_attachment_family', '001_016_attachment.family_016', '=', '001_015_attachment_family.id_015')
            ->orderBy('001_016_attachment.sorting_016');
    }
}