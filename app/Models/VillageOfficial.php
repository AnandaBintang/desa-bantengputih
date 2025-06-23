<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VillageOfficial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'village_id'
    ];

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
