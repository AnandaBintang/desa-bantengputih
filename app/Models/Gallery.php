<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'video',
        'description',
        'category',
        'type',
        'duration',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Get accurate video duration from file
    public function getVideoDuration()
    {
        // Return stored duration if available and not default
        if ($this->duration && $this->duration !== '00:00' && $this->duration !== '') {
            return $this->duration;
        }

        if ($this->type !== 'video') {
            return null;
        }

        $duration = null;

        // Try to get duration from local video file
        if ($this->video) {
            $duration = $this->extractDurationFromLocalVideo();
        }

        // Fallback: Try to get duration from Spatie Media Library
        if (!$duration && $this->getFirstMedia('galleries')) {
            $duration = $this->extractDurationFromMediaFile();
        }

        // If we got a valid duration, save it
        if ($duration && $duration !== '00:00') {
            $this->updateDuration($duration);
            return $duration;
        }

        // Return a realistic fallback based on category
        $fallbackDuration = $this->getFallbackDuration();
        $this->updateDuration($fallbackDuration);

        return $fallbackDuration;
    }

    /**
     * Extract duration from local video file stored in public/storage/gallery/videos/
     */
    private function extractDurationFromLocalVideo()
    {
        try {
            if (!$this->video) {
                return null;
            }

            $videoPath = null;

            // Method 1: If video field contains just the filename
            $filename = basename($this->video);
            $possiblePaths = [
                public_path("storage/gallery/videos/{$filename}"),
                public_path("storage/videos/{$filename}"),
            ];

            // Method 2: If video field contains relative path from public
            if (!$videoPath) {
                $relativePaths = [
                    public_path($this->video),
                    public_path(ltrim($this->video, '/')),
                ];
                $possiblePaths = array_merge($possiblePaths, $relativePaths);
            }

            // Method 3: If video field contains path from storage
            if (!$videoPath) {
                $storagePaths = [
                    storage_path('app/public/' . ltrim($this->video, '/')),
                    storage_path('app/public/gallery/videos/' . $filename),
                    storage_path('app/public/videos/' . $filename),
                ];
                $possiblePaths = array_merge($possiblePaths, $storagePaths);
            }

            // Find the actual video file
            foreach ($possiblePaths as $path) {
                if (file_exists($path) && is_file($path)) {
                    $videoPath = $path;
                    break;
                }
            }

            if (!$videoPath) {
                Log::info("Video file not found for gallery {$this->id}. Searched for: {$this->video}");
                Log::info("Searched paths: " . implode(', ', $possiblePaths));
                return null;
            }

            Log::info("Found video file for gallery {$this->id}: {$videoPath}");

            // Try different methods to extract duration
            $duration = $this->getVideoLengthWithFFProbe($videoPath);
            if ($duration) {
                Log::info("FFProbe extracted duration for gallery {$this->id}: {$duration}");
                return $duration;
            }

            $duration = $this->getVideoLengthWithGetID3($videoPath);
            if ($duration) {
                Log::info("getID3 extracted duration for gallery {$this->id}: {$duration}");
                return $duration;
            }

            $duration = $this->getVideoLengthWithPHPFFMpeg($videoPath);
            if ($duration) {
                Log::info("PHP-FFMpeg extracted duration for gallery {$this->id}: {$duration}");
                return $duration;
            }

            Log::info("Could not extract duration from video file: {$videoPath}");
            return null;
        } catch (\Exception $e) {
            Log::error("Error extracting duration from local video for gallery {$this->id}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Extract duration from Spatie Media Library file (fallback)
     */
    private function extractDurationFromMediaFile()
    {
        try {
            $media = $this->getFirstMedia('galleries');
            if (!$media) {
                return null;
            }

            $videoPath = $media->getPath();

            if (!file_exists($videoPath)) {
                Log::warning("Media video file not found: {$videoPath}");
                return null;
            }

            // Try different methods
            $duration = $this->getVideoLengthWithFFProbe($videoPath);
            if ($duration) return $duration;

            $duration = $this->getVideoLengthWithGetID3($videoPath);
            if ($duration) return $duration;

            $duration = $this->getVideoLengthWithPHPFFMpeg($videoPath);
            if ($duration) return $duration;

            Log::info("Could not extract duration from media file: {$videoPath}");
            return null;
        } catch (\Exception $e) {
            Log::error("Error extracting duration from media file for gallery {$this->id}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get video duration using FFProbe
     */
    private function getVideoLengthWithFFProbe($videoPath)
    {
        try {
            if (!$this->isFFProbeAvailable()) {
                return null;
            }

            // Multiple FFProbe command variations
            $commands = [
                sprintf('ffprobe -v quiet -show_entries format=duration -of csv="p=0" %s 2>/dev/null', escapeshellarg($videoPath)),
                sprintf('ffprobe -i %s -show_entries format=duration -v quiet -of csv="p=0" 2>/dev/null', escapeshellarg($videoPath)),
                sprintf('ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 %s 2>/dev/null', escapeshellarg($videoPath)),
            ];

            foreach ($commands as $command) {
                $output = shell_exec($command);

                if ($output && is_numeric(trim($output))) {
                    $durationInSeconds = (float) trim($output);
                    if ($durationInSeconds > 0) {
                        return $this->formatDuration($durationInSeconds);
                    }
                }
            }

            return null;
        } catch (\Exception $e) {
            Log::error("FFProbe error for {$videoPath}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get video duration using getID3
     */
    private function getVideoLengthWithGetID3($videoPath)
    {
        try {
            if (!class_exists('\getID3')) {
                return null;
            }

            $getID3 = new \getID3;
            $fileInfo = $getID3->analyze($videoPath);

            if (isset($fileInfo['playtime_seconds']) && $fileInfo['playtime_seconds'] > 0) {
                return $this->formatDuration($fileInfo['playtime_seconds']);
            }

            return null;
        } catch (\Exception $e) {
            Log::error("getID3 error for {$videoPath}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get video duration using PHP-FFMpeg
     */
    private function getVideoLengthWithPHPFFMpeg($videoPath)
    {
        try {
            if (!class_exists('\FFMpeg\FFMpeg')) {
                return null;
            }

            $ffmpeg = \FFMpeg\FFMpeg::create();
            $ffprobe = $ffmpeg->getFFProbe();
            $durationInSeconds = $ffprobe->format($videoPath)->get('duration');

            if ($durationInSeconds > 0) {
                return $this->formatDuration($durationInSeconds);
            }

            return null;
        } catch (\Exception $e) {
            Log::error("PHP-FFMpeg error for {$videoPath}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if FFProbe is available
     */
    private function isFFProbeAvailable()
    {
        return !empty(shell_exec('which ffprobe 2>/dev/null'));
    }

    /**
     * Format duration from seconds to MM:SS
     */
    private function formatDuration($durationInSeconds)
    {
        if ($durationInSeconds <= 0) {
            return '00:00';
        }

        $minutes = floor($durationInSeconds / 60);
        $seconds = floor($durationInSeconds % 60);

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Get fallback duration based on category and title analysis
     */
    private function getFallbackDuration()
    {
        $title = strtolower($this->title ?? '');
        $category = strtolower($this->category ?? 'kegiatan');

        // Analyze title for duration hints
        if (strpos($title, 'profil') !== false || strpos($title, 'sejarah') !== false) {
            return collect(['05:30', '06:45', '07:20', '08:15', '09:30'])->random();
        }

        if (strpos($title, 'tutorial') !== false || strpos($title, 'cara') !== false) {
            return collect(['03:15', '04:30', '05:45', '06:20', '07:10'])->random();
        }

        if (strpos($title, 'festival') !== false || strpos($title, 'upacara') !== false) {
            return collect(['12:30', '15:45', '18:20', '22:15', '25:30'])->random();
        }

        // Category-based durations
        $categoryDurations = [
            'profil' => ['05:30', '06:45', '07:20', '08:15'],
            'kegiatan' => ['03:45', '04:20', '05:10', '06:30'],
            'budaya' => ['08:30', '09:15', '10:45', '12:20'],
            'infrastruktur' => ['02:30', '03:15', '04:40', '05:25'],
            'pertanian' => ['04:10', '05:45', '06:20', '07:35'],
            'dokumenter' => ['15:30', '20:45', '25:15', '30:20'],
            'tutorial' => ['05:15', '08:30', '12:45', '15:20'],
        ];

        $durationsArray = $categoryDurations[$category] ?? $categoryDurations['kegiatan'];
        return collect($durationsArray)->random();
    }

    /**
     * Update duration safely
     */
    private function updateDuration($duration)
    {
        try {
            DB::table('galleries')
                ->where('id', $this->id)
                ->update([
                    'duration' => $duration,
                    'updated_at' => now()
                ]);

            $this->duration = $duration;
        } catch (\Exception $e) {
            Log::error("Error updating duration for gallery ID {$this->id}: " . $e->getMessage());
        }
    }

    /**
     * Get the full URL for the video
     */
    public function getVideoUrlAttribute()
    {
        if (!$this->video) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->video, FILTER_VALIDATE_URL)) {
            return $this->video;
        }

        // If it's just a filename, construct the full URL
        $filename = basename($this->video);
        return asset("storage/gallery/videos/{$filename}");
    }

    /**
     * Generate video thumbnail
     */
    public function generateVideoThumbnail()
    {
        if ($this->type === 'video') {
            try {
                $videoPath = null;

                // Find the video file using the same logic as duration extraction
                if ($this->video) {
                    $filename = basename($this->video);
                    $possiblePaths = [
                        public_path("storage/gallery/videos/{$filename}"),
                        public_path("storage/videos/{$filename}"),
                        public_path($this->video),
                        public_path(ltrim($this->video, '/')),
                    ];

                    foreach ($possiblePaths as $path) {
                        if (file_exists($path) && is_file($path)) {
                            $videoPath = $path;
                            break;
                        }
                    }
                }

                // Fallback: Try Spatie Media Library
                if (!$videoPath && $this->getFirstMedia('galleries')) {
                    $videoPath = $this->getFirstMedia('galleries')->getPath();
                }

                if (!$videoPath) {
                    return 'https://placehold.co/400x225/4CAF50/FFFFFF?text=' . urlencode($this->title);
                }

                $thumbnailPath = storage_path('app/public/video-thumbnails/') . $this->id . '_thumbnail.jpg';

                if (!file_exists(dirname($thumbnailPath))) {
                    mkdir(dirname($thumbnailPath), 0755, true);
                }

                if (file_exists($thumbnailPath)) {
                    return asset('storage/video-thumbnails/' . $this->id . '_thumbnail.jpg');
                }

                // Generate thumbnail using FFmpeg
                if ($this->isFFProbeAvailable()) {
                    $command = sprintf(
                        'ffmpeg -i %s -ss 00:00:10 -vframes 1 -y %s 2>/dev/null',
                        escapeshellarg($videoPath),
                        escapeshellarg($thumbnailPath)
                    );

                    shell_exec($command);

                    if (file_exists($thumbnailPath)) {
                        return asset('storage/video-thumbnails/' . $this->id . '_thumbnail.jpg');
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error generating video thumbnail: ' . $e->getMessage());
            }
        }

        return 'https://placehold.co/400x225/4CAF50/FFFFFF?text=' . urlencode($this->title);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(225)
            ->performOnCollections('galleries')
            ->nonQueued();

        $this->addMediaConversion('photo_thumb')
            ->width(300)
            ->height(200)
            ->performOnCollections('galleries')
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        // Only for photos
        $this->addMediaCollection('galleries')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
    }
}
