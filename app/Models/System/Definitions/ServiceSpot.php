<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Znck\Eloquent\Traits\BelongsToThrough;

class ServiceSpot extends Model
{
    use HasFactory;
    use BelongsToThrough;

    protected $fillable = [
        'is_active',
        'name',
        'spot_type_id',
        'area_id',
        'notes'
    ];



    public function spotType() :BelongsTo
    {
        return $this->belongsTo(ServiceSpotType::class);
    }

    public function area() :BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function district(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough(District::class, Area::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(BuildingBlock::class);
    }
}
