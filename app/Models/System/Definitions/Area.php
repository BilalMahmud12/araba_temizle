<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'district_id',
        'name',
        'notes'
    ];

    public function Spots() :HasMany
    {
        return $this->hasMany(ServiceSpot::class);
    }

    public function district() :BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function scopeActive()
    {
        return Area::where('is_active', 1)->orderByDesc('id')->get();
    }

    public function scopeForSelectBox()
    {
        return Area::where('is_active', 1)->select('id', 'name')->orderByDesc('id')->get();
    }
}
