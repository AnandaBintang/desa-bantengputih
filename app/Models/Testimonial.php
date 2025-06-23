<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'message',
        'photo',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
