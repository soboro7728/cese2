<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加分
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Region;
use App\Models\Genre;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        $auths = Auth::user();
        $regions = Region::all();
        $genres = Genre::all();
        $auth_id = $auths->id;
        $shops = Shop::all();
        $reservations = Reservation::where('user_id', $auth_id)->whereNull('review')->get();
        $favorites = Favorite::where('user_id', $auth_id)->get();
        $now = Carbon::now();
        return view('auth.mypage', compact('shops','reservations', 'favorites','regions','genres','auths','now',));
    }

    public function favorites_create(Request $request)
    {
        $auths = Auth::user();
        $user_id = $auths->id;
        $favorite =
        [
            'user_id' => $user_id,
            'shop_id' => $request->shop_id,
        ];
        favorite::create($favorite);
        return redirect('/');
    }

    public function favorites_delete(Request $request)
    {
        $auths = Auth::user();
        $user_id = $auths->id;
        $shop_id = $request->shop_id;
        // 検索条件
        $cond = ['user_id' => $user_id, 'shop_id' => $shop_id];
        favorite::where($cond)->delete();
        return redirect('/');
    }
    public function favorites_delete_mypage(Request $request)
    {
        $auths = Auth::user();
        $user_id = $auths->id;
        $shop_id = $request->shop_id;
        // 検索条件
        $cond = ['user_id' => $user_id, 'shop_id' => $shop_id];
        favorite::where($cond)->delete();
        return redirect('/mypage');
    }
    // テスト追加項目

}
