<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', false);
    }

    public function scopeRead($query)
    {
        return $query->where('status', true);
    }
}
