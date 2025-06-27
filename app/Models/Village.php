<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    // Get the first village record (main village info)
    public static function getMainVillage()
    {
        return static::first();
    }

    // Get logo URL
    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }

    // Get formatted phone for WhatsApp
    public function getWhatsappUrlAttribute()
    {
        if (!$this->phone) return null;

        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return "https://wa.me/{$phone}";
    }
}
