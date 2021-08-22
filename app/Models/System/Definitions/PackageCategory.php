<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackageCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'notes'
    ];

    public function packages() :HasMany
    {
        return $this->hasMany(Package::class);
    }
}
