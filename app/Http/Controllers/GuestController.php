<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function enter()
{
    session(['guest_mode' => true]);
    return redirect()->route('admin.restaurants.index');
}
}
