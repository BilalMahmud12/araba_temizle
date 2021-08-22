<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceSpotType extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'notes'
    ];

    public function Spots() :HasMany
    {
        return $this->hasMany(ServiceSpot::class);
    }
}
