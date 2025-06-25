<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class News extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'published_at',
        'user_id',
        'category',
        'is_featured',
        'views_count',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_featured' => 'boolean',
        'tags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('content', 'like', '%' . $searchTerm . '%')
            ->orWhere('excerpt', 'like', '%' . $searchTerm . '%');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCategoryLabelAttribute()
    {
        return match ($this->category) {
            'pembangunan' => 'Pembangunan',
            'sosial' => 'Sosial',
            'ekonomi' => 'Ekonomi',
            'budaya' => 'Budaya',
            default => 'Umum',
        };
    }

    public function getCategoryIconAttribute()
    {
        return match ($this->category) {
            'pembangunan' => 'fas fa-hammer',
            'sosial' => 'fas fa-users',
            'ekonomi' => 'fas fa-chart-line',
            'budaya' => 'fas fa-theater-masks',
            default => 'fas fa-newspaper',
        };
    }

    public function getCategoryColorAttribute()
    {
        return match ($this->category) {
            'pembangunan' => 'blue',
            'sosial' => 'yellow',
            'ekonomi' => 'green',
            'budaya' => 'purple',
            default => 'gray',
        };
    }

    public function getFeaturedImageAttribute()
    {
        if ($this->getFirstMedia('featured')) {
            return $this->getFirstMedia('featured')->getUrl();
        }

        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return 'https://placehold.co/600x400/4CAF50/FFFFFF?text=' . urlencode($this->title);
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        return Str::limit(strip_tags($this->content), 150);
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getFormattedContentAttribute()
    {
        // Convert line breaks to HTML
        $content = nl2br(e($this->content));

        // You can add more formatting here if needed
        return $content;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(250)
            ->performOnCollections('featured');

        $this->addMediaConversion('large')
            ->width(800)
            ->height(500)
            ->performOnCollections('featured');
    }

    public static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
            ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = static::generateUniqueSlug($news->title);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = static::generateUniqueSlug($news->title, $news->id);
            }
        });
    }
}
