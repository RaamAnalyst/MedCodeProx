<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IcdPcsOrder extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'icd_pcs_orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PCS_CATEGORY_RADIO = [
        '0' => 'Header',
        '1' => 'Non-Header',
    ];

    public static $searchable = [
        'pcs_order_number',
        'icd_pcs_code',
        'pcs_category',
        'pcs_short_desc',
        'pcs_long_desc',
    ];

    protected $fillable = [
        'pcs_order_number',
        'icd_pcs_code',
        'pcs_category',
        'pcs_short_desc',
        'pcs_long_desc',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
