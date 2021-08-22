<?php

namespace App\Models\System\Definitions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceContract extends Model
{
    use HasFactory;

    protected $fillable = [
      'is_active',
      'name',
      'content'
    ];

    protected $casts = [
        'updated_at'  => 'datetime:D, d-m-Y H:s',
        'created_at' => 'datetime:Y-m-d H:00',
    ];
}
