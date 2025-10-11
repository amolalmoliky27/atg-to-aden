<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.news');
    }

    public function getNews(Request $request)
    {
        $category = $request->input('category', '');
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $query = News::query();

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $news = $query->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($news);
    }

    public function getLatestNews()
    {
        $latestNews = News::orderBy('created_at', 'desc')->limit(5)->get();
        return response()->json($latestNews);
    }
}
