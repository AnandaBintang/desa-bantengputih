<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'address',
        'phone',
        'email',
        'website',
    ];
}
