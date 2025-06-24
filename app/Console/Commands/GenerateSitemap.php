<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate XML sitemap for the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Static pages
        $pages = [
            ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => '/tentang', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/berita', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => '/galeri', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/produk', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/layanan', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/pengaduan', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/transparansi', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/kontak', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach ($pages as $page) {
            $sitemap .= '  <url>' . PHP_EOL;
            $sitemap .= '    <loc>' . config('app.url') . $page['url'] . '</loc>' . PHP_EOL;
            $sitemap .= '    <lastmod>' . now()->toISOString() . '</lastmod>' . PHP_EOL;
            $sitemap .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . PHP_EOL;
            $sitemap .= '    <priority>' . $page['priority'] . '</priority>' . PHP_EOL;
            $sitemap .= '  </url>' . PHP_EOL;
        }

        $sitemap .= '</urlset>';

        File::put(public_path('sitemap.xml'), $sitemap);

        $this->info('Sitemap generated successfully!');
    }
}
