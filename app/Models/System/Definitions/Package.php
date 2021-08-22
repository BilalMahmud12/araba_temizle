<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'package_category_id',
        'service_contract_id',
        'name',
        'price',
        'notes',
    ];

    public function packageCategory() :BelongsTo
    {
        return $this->belongsTo(PackageCategory::class);
    }

    public function serviceContract() :BelongsTo
    {
        return $this->belongsTo(ServiceContract::class);
    }
}
