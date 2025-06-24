<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'category',
        'type',
        'description',
        'file',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function getFileUrlAttribute(): ?string
    {
        return $this->file ? Storage::url($this->file) : null;
    }

    public function getFileSizeAttribute(): ?string
    {
        if (!$this->file || !Storage::exists($this->file)) {
            return null;
        }

        $bytes = Storage::size($this->file);
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileExtensionAttribute(): ?string
    {
        return $this->file ? pathinfo($this->file, PATHINFO_EXTENSION) : null;
    }

    public function isPdf(): bool
    {
        return $this->file_extension === 'pdf';
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
