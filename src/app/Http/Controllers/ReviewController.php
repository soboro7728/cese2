<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class ReviewController extends Controller
{
    //
    public function form(Request $request)
    {
        $shop_id = $request->shop_id;
        $shop = Shop::where('id', "$shop_id")->first();
        return view("auth.review", compact('shop'));
    }
    public function create(Request $request)
    {
        $user_id = Auth::id();
        $review = [
            'user_id' => $user_id,
            'shop_id' => $request->shop_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ];
        Review::create($review);
        return view("auth.complete");
    }
    public function index(Request $request)
    {
        $shop_id = $request->id;
        $reviews = Review::where('shop_id', $shop_id)->get();
        return view("review", compact('reviews'));
    }
}
