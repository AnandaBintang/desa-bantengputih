<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GuestSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'description',
        'type',
        'category',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
        'gallery_id',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    public function getFileSizeHumanAttribute()
    {
        $bytes = (int) $this->file_size;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' bytes';
    }

    public function getStatusBadgeColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Menunggu Review',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    // Methods
    public function approve($adminId, $adminNotes = null)
    {
        $this->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'reviewed_by' => $adminId,
            'admin_notes' => $adminNotes,
        ]);

        // Create gallery entry
        $this->createGalleryEntry();
    }

    public function reject($adminId, $adminNotes = null)
    {
        $this->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => $adminId,
            'admin_notes' => $adminNotes,
        ]);
    }

    private function createGalleryEntry()
    {
        if ($this->status !== 'approved' || $this->gallery_id) {
            return;
        }

        $galleryData = [
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'type' => $this->type,
        ];

        if ($this->type === 'video') {
            // Move video file to gallery videos directory
            $newPath = 'gallery/videos/' . $this->file_name;
            Storage::disk('public')->move($this->file_path, $newPath);
            $galleryData['video'] = $newPath;
        }

        $gallery = Gallery::create($galleryData);

        if ($this->type === 'photo') {
            // Add photo to Spatie Media Library
            $fullPath = Storage::disk('public')->path($this->file_path);
            $gallery->addMedia($fullPath)
                ->toMediaCollection('galleries');
        }

        // Update submission with gallery ID
        $this->update(['gallery_id' => $gallery->id]);
    }

    public function deleteFile()
    {
        if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
            Storage::disk('public')->delete($this->file_path);
        }
    }

    // Delete file when model is deleted
    protected static function booted()
    {
        static::deleting(function ($submission) {
            $submission->deleteFile();
        });
    }
}
