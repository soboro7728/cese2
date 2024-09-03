<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function form(Request $request)
    {
        $reservation_id = $request->reservation_id;
        $reservation = Reservation::with('shop')->where('id', "$reservation_id")->first();
        return view("auth.review", compact('reservation'));
    }
    public function create(Request $request)
    {
        $user_id = Auth::id();
        $now = Carbon::now();
        $review = [
            'user_id' => $user_id,
            'shop_id' => $request->shop_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ];
        Review::create($review);
        $reservation = Reservation::where('id', $request->reservation_id)
            ->update([
                'review' => $now
            ]);
        return view("auth.complete");
    }
    public function index(Request $request)
    {
        $shop_id = $request->id;
        $reviews = Review::where('shop_id', $shop_id)->get();
        return view("review", compact('reviews'));
    }
    public function post(Request $request)
    {
        $shop_id = $request->shop_id;
        $shop = Shop::where('id', $shop_id)->first();
        return view("shop.review.post", compact('shop'),);
    }
    public function action(Request $request)
    {
        $id = Auth::id();
        $image = $request->file('upload_file')->store('public/image/');
        $image_path = basename($image);
        $review = [
            'user_id' => $id,
            'shop_id' => $request->shop_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
            'image_path' => $image_path,
        ];
        Review::create($review);
        return view("test", );
    }
}
