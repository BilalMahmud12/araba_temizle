<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'notes'
    ];

    public function areas() :HasMany
    {
        return $this->hasMany(Area::class);
    }

    public function serviceSpots() :HasManyThrough
    {
        return $this->HasManyThrough(ServiceSpot::class, Area::class);
    }

    public function scopeActive()
    {
        return District::where('is_active', 1)->orderByDesc('id')->get();
    }

    public function scopeForSelectBox()
    {
        return District::where('is_active', 1)->select('id', 'name')->orderByDesc('id')->get();
    }
}
