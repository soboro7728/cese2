<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function form(Request $request)
    {
        return view("auth.review");
    }
}
