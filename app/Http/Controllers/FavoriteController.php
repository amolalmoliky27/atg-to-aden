<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Tran;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Tran $tran)
    {
        $user = Auth::user();

        $existing = Favorite::where('user_id', $user->id)
                            ->where('tran_id', $tran->id)
                            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'tran_id' => $tran->id,
            ]);
        }

        return redirect()->back();

    }

    public function index()
    {
        $user = auth()->user();
       
        $favorites = $user->favorites()->with('tran')->get();

        return view('favorites', compact('favorites'));
    }
}




