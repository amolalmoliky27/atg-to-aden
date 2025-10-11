<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('replies')->get();
        $overallRating = Review::avg('rating');
        $totalReviews = Review::count();

        // حساب توزيع التقييمات
        $ratingDistribution = [
            5 => Review::where('rating', 5)->count(),
            4 => Review::where('rating', 4)->count(),
            3 => Review::where('rating', 3)->count(),
            2 => Review::where('rating', 2)->count(),
            1 => Review::where('rating', 1)->count(),
        ];

        return view('reviews.index', compact(
            'reviews',
            'overallRating',
            'totalReviews',
            'ratingDistribution'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $sentiment = $request->rating >= 4 ? 'positive' : 'negative';

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'sentiment' => $sentiment,
        ]);

        return redirect()->route('reviews.index')->with('success', 'تم إضافة التقييم بنجاح!');
    }

    public function reply(Request $request, Review $review)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string|min:5|max:500',
        ]);

        $review->replies()->create([
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'تم إضافة الرد بنجاح!');
    }
}
