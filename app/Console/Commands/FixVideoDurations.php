<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixVideoDurations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gallery:fix-durations {--force : Force update all video durations} {--detailed : Show detailed output}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix video durations for existing gallery items by extracting from actual video files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎬 Starting video duration extraction process...');
        $this->newLine();

        $this->checkRequirements();

        $query = Gallery::where('type', 'video');

        if (!$this->option('force')) {
            $query->where(function ($q) {
                $q->whereNull('duration')
                    ->orWhere('duration', '00:00')
                    ->orWhere('duration', '');
            });
        }

        $videos = $query->get();

        if ($videos->count() === 0) {
            $this->info('✅ No videos need duration fixing.');
            return 0;
        }

        $this->info("📹 Found {$videos->count()} videos to process");
        $this->newLine();

        $progressBar = $this->output->createProgressBar($videos->count());
        $progressBar->setFormat('debug');

        $processed = 0;
        $extracted = 0;
        $fallbacks = 0;
        $errors = 0;

        foreach ($videos as $video) {
            try {
                $oldDuration = $video->duration;

                // Clear existing duration to force re-extraction
                if ($this->option('force')) {
                    DB::table('galleries')->where('id', $video->id)->update(['duration' => null]);
                    $video->duration = null;
                }

                $newDuration = $video->getVideoDuration();

                if ($newDuration && $newDuration !== '00:00') {
                    $processed++;

                    // Check if this was extracted from file or fallback
                    if ($video->getFirstMedia('galleries') && $this->isDurationExtracted($video)) {
                        $extracted++;
                        $icon = '🎯';
                        $method = 'EXTRACTED';
                    } else {
                        $fallbacks++;
                        $icon = '🔄';
                        $method = 'FALLBACK';
                    }

                    if ($this->option('detailed')) {
                        $this->newLine();
                        $this->info("{$icon} Video ID {$video->id}: '{$video->title}'");
                        $this->info("   Duration: {$oldDuration} → {$newDuration} ({$method})");
                        $this->info("   Category: {$video->category}");
                        if ($video->getFirstMedia('galleries')) {
                            $this->info("   File: " . $video->getFirstMedia('galleries')->file_name);
                            $this->info("   Path: " . $video->getFirstMedia('galleries')->getPath());
                        } elseif ($video->video) {
                            $this->info("   URL: " . $video->video);
                        }
                    }
                } else {
                    $errors++;
                    if ($this->option('detailed')) {
                        $this->newLine();
                        $this->warn("⚠️ Video ID {$video->id}: '{$video->title}' - Could not determine duration");
                        if ($video->getFirstMedia('galleries')) {
                            $this->warn("   File exists but duration extraction failed");
                        } else {
                            $this->warn("   No media file found");
                        }
                    }
                }
            } catch (\Exception $e) {
                $errors++;
                if ($this->option('detailed')) {
                    $this->newLine();
                    $this->error("❌ Video ID {$video->id}: '{$video->title}' - Error: " . $e->getMessage());
                }
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info('🎉 Completed video duration processing!');
        $this->newLine();

        // Results summary
        $this->table(['Result', 'Count', 'Percentage'], [
            ['✅ Successfully Processed', $processed, round(($processed / $videos->count()) * 100, 1) . '%'],
            ['🎯 Extracted from Files', $extracted, round(($extracted / $videos->count()) * 100, 1) . '%'],
            ['🔄 Used Fallback', $fallbacks, round(($fallbacks / $videos->count()) * 100, 1) . '%'],
            ['❌ Errors', $errors, round(($errors / $videos->count()) * 100, 1) . '%'],
        ]);

        if ($extracted > 0) {
            $this->info("🎯 {$extracted} videos had their duration extracted from actual video files!");
        }

        if ($fallbacks > 0) {
            $this->warn("🔄 {$fallbacks} videos used fallback durations (no video file found).");
            if (!$this->option('detailed')) {
                $this->warn("   Use --detailed flag to see which videos used fallbacks.");
            }
        }

        if ($errors > 0) {
            $this->error("❌ {$errors} videos encountered errors during processing.");
            if (!$this->option('detailed')) {
                $this->error("   Use --detailed flag to see error details.");
            }
        }

        // Show recommendations
        $this->newLine();
        $this->info('💡 Recommendations:');

        if ($extracted === 0 && $processed > 0) {
            $this->warn('   • No durations were extracted from video files');
            $this->warn('   • Consider installing FFmpeg: sudo apt install ffmpeg');
            $this->warn('   • Or install getID3: composer require james-heinrich/getid3');
        }

        if ($fallbacks > 0) {
            $this->info('   • Upload video files to get accurate durations');
            $this->info('   • Current fallback durations are category-based estimates');
        }

        return 0;
    }

    private function checkRequirements()
    {
        $this->info('🔍 Checking system requirements...');

        // Check FFmpeg/FFProbe
        $ffprobeAvailable = !empty(shell_exec('which ffprobe 2>/dev/null'));
        $this->info($ffprobeAvailable ? '✅ FFProbe: Available' : '⚠️ FFProbe: Not available');

        // Check getID3
        $getid3Available = class_exists('\getID3');
        $this->info($getid3Available ? '✅ getID3: Available' : '⚠️ getID3: Not available');

        // Check PHP FFmpeg extension
        $phpFfmpegAvailable = class_exists('\FFMpeg\FFMpeg');
        $this->info($phpFfmpegAvailable ? '✅ PHP-FFMpeg: Available' : '⚠️ PHP-FFMpeg: Not available');

        if (!$ffprobeAvailable && !$getid3Available && !$phpFfmpegAvailable) {
            $this->warn('⚠️ No video analysis tools available. Only fallback durations will be used.');
            $this->newLine();
            $this->warn('   To get accurate durations, install one of the following:');
            $this->warn('   1. FFmpeg: sudo apt install ffmpeg');
            $this->warn('   2. getID3: composer require james-heinrich/getid3');
            $this->warn('   3. PHP-FFMpeg: composer require php-ffmpeg/php-ffmpeg');
        }

        $this->newLine();
    }

    private function isDurationExtracted($video)
    {
        // Simple heuristic: if we have a media file and the duration doesn't match
        // common fallback patterns, it was likely extracted
        $duration = $video->duration;

        // Common fallback patterns we use
        $commonFallbacks = [
            // Kegiatan
            '03:45',
            '04:20',
            '05:10',
            '06:30',
            // Profil
            '05:30',
            '06:45',
            '07:20',
            '08:15',
            '09:30',
            // Budaya
            '08:30',
            '09:15',
            '10:45',
            '12:20',
            // Infrastruktur
            '02:30',
            '03:15',
            '04:40',
            '05:25',
            // Pertanian
            '04:10',
            '05:45',
            '06:20',
            '07:35',
            // Dokumenter
            '15:30',
            '20:45',
            '25:15',
            '30:20',
            // Tutorial
            '05:15',
            '08:30',
            '12:45',
            '15:20',
            // Festival patterns
            '12:30',
            '15:45',
            '18:20',
            '22:15',
            '25:30',
            // Tutorial patterns
            '03:15',
            '04:30',
            '05:45',
            '06:20',
            '07:10'
        ];

        return !in_array($duration, $commonFallbacks);
    }
}
