<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuildingBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'service_spot_id',
        'name',
        'notes'
    ];

    public function ServiceSpot() :BelongsTo
    {
        return $this->belongsTo(ServiceSpot::class);
    }
}
