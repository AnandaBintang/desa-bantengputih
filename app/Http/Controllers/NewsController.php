<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->get('category', 'semua');
        $search = $request->get('search');

        $query = News::published()->recent();

        // Filter by category
        if ($category && $category !== 'semua') {
            $query->where('category', $category);
        }

        // Search functionality
        if ($search) {
            $query->search($search);
        }

        $featuredNews = News::published()
            ->featured()
            ->recent()
            ->first();

        if ($featuredNews) {
            $media = $featuredNews->getFirstMedia('news');
            $featuredNews->media_url = $media ? $media->getUrl() : null;
        }

        $news = $query->paginate(6);

        // Attach media_url to each news item
        $news->getCollection()->transform(function ($item) {
            $media = $item->getFirstMedia('news');
            $item->media_url = $media ? $media->getUrl() : null;
            return $item;
        });

        $categories = [
            'semua' => ['name' => 'Semua Berita', 'icon' => 'fas fa-globe', 'color' => 'bg-primary'],
            'pembangunan' => ['name' => 'Pembangunan', 'icon' => 'fas fa-hammer', 'color' => 'bg-blue-500'],
            'sosial' => ['name' => 'Sosial', 'icon' => 'fas fa-users', 'color' => 'bg-yellow-500'],
            'ekonomi' => ['name' => 'Ekonomi', 'icon' => 'fas fa-chart-line', 'color' => 'bg-green-500'],
            'budaya' => ['name' => 'Budaya', 'icon' => 'fas fa-theater-masks', 'color' => 'bg-purple-500'],
        ];

        return view('pages.news.index', compact('news', 'featuredNews', 'categories', 'category', 'search'));
    }

    public function show(News $news): View
    {
        // Only show published news
        if (!$news->published_at || $news->published_at > now()) {
            abort(404);
        }

        // Increment views
        $news->incrementViews();

        // Get related news
        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->where('category', $news->category)
            ->recent()
            ->limit(3)
            ->get();

        // Attach media_url to related news items
        $relatedNews->each(function ($item) {
            $media = $item->getFirstMedia('news');
            $item->media_url = $media ? $media->getUrl() : null;
        });

        // Attach media_url to the news item
        $media = $news->getFirstMedia('news');
        $news->media_url = $media ? $media->getUrl() : null;

        $categories = [
            'semua' => ['name' => 'Semua Berita', 'icon' => 'fas fa-globe', 'color' => 'bg-primary'],
            'pembangunan' => ['name' => 'Pembangunan', 'icon' => 'fas fa-hammer', 'color' => 'bg-blue-500'],
            'sosial' => ['name' => 'Sosial', 'icon' => 'fas fa-users', 'color' => 'bg-yellow-500'],
            'ekonomi' => ['name' => 'Ekonomi', 'icon' => 'fas fa-chart-line', 'color' => 'bg-green-500'],
            'budaya' => ['name' => 'Budaya', 'icon' => 'fas fa-theater-masks', 'color' => 'bg-purple-500'],
        ];

        return view('pages.news.show', compact('news', 'relatedNews', 'categories'));
    }

    public function loadMore(Request $request)
    {
        $category = $request->get('category', 'semua');
        $page = $request->get('page', 1);

        $query = News::published()->recent();

        if ($category && $category !== 'semua') {
            $query->where('category', $category);
        }

        $news = $query->paginate(6, ['*'], 'page', $page);

        $html = '';
        foreach ($news as $article) {
            $html .= view('components.news.card-item', compact('article'))->render();
        }

        return response()->json([
            'html' => $html,
            'hasMore' => $news->hasMorePages()
        ]);
    }
}
