<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
 use App\Models\Post;

 class ReactionController extends Controller {
     public function react(Request $request, Post $post) 
     { Reaction::updateOrCreate( ['user_id' => auth()->id(), 'post_id' => $post->id],
         ['type' => $request->type] ); return response()->json(['status' => 'success']); } }
