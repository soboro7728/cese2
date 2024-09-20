<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;
use App\Http\Requests\ReviewRequest;

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
    public function action(ReviewRequest $request)
    {
        $id = Auth::id();
        $shop_id = $request->shop_id;
        $old_review = Review::where('shop_id', $shop_id)
        ->where('user_id',$id)
        ->first();
        if($old_review != null){
            return view("shop.review.complete.error",);
        }
        if ($request->file('upload_file') == null) {
            $image_path = null;
        } else {
            $image = $request->file('upload_file')->store('public/image/');
            $image_path = basename($image);
        }
        $review = [
            'user_id' => $id,
            'shop_id' => $request->shop_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
            'image_path' => $image_path,
        ];
        Review::create($review);
        return view("shop.review.complete.post", );
    }
    public function edit(Request $request)
    {
        $shop_id = $request->shop_id;
        $shop = Shop::where('id', $shop_id)->first();
        $auth_id = Auth::id();
        $review = Review::where('shop_id', $shop_id)
        ->where('user_id',$auth_id)
        ->with('shop')
        ->first();
        return view("shop.review.edit",compact('review','shop'));
    }
    public function update(ReviewRequest $request)
    {
        $auth_id = Auth::id();
        $shop_id = $request->shop_id;
        if($request->file('upload_file')==null){
            $image_path = null;
        }else{
            $image = $request->file('upload_file')->store('public/image/');
            $image_path = basename($image);
        }
        if($request->old_image!=null && $image_path==null){
            $review = Review::where('user_id', $auth_id)
            ->where('shop_id', $shop_id)
            ->update([
                'user_id' => $auth_id,
                'shop_id' => $request->shop_id,
                'stars' => $request->stars,
                'comment' => $request->comment,
            ]);
        }else{
            $review = Review::where('user_id', $auth_id)
            ->where('shop_id', $shop_id)
            ->update([
                'user_id' => $auth_id,
                'shop_id' => $request->shop_id,
                'stars' => $request->stars,
                'comment' => $request->comment,
                'image_path' => $image_path,
            ]);
        }
        return view("shop.review.complete.edit",);
    }
    public function delete(Request $request)
    {
        $auth_id = Auth::id();
        $shop_id = $request->shop_id;
        $old_review = Review::where('shop_id', $shop_id)
        ->where('user_id', $auth_id)
        ->first();
        if ($old_review == null) {
            return view("shop.review.complete.error",);
        }
        $review = Review::where('user_id', $auth_id)
            ->where('shop_id', $shop_id)
            ->delete();
        return view("shop.review.complete.delete",);
    }
    public function image(Request $request)
    {
        $auth_id = Auth::id();
        $shop_id = $request->shop_id;
        $image_path = null;
        $review = Review::where('user_id', $auth_id)
            ->where('shop_id', $shop_id)
            ->update([
                'user_id' => $auth_id,
                'shop_id' => $request->shop_id,
                'stars' => $request->stars,
                'comment' => $request->comment,
                'image_path' => $image_path,
            ]);
        $shop = Shop::where('id', $shop_id)->first();
        $review = Review::where('shop_id', $shop_id)
        ->where('user_id', $auth_id)
        ->with('shop')
        ->first();
        return view("shop.review.edit", compact('review', 'shop'));
    }
}
