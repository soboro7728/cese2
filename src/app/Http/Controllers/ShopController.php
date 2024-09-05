<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shoptime;
use App\Models\Condition;
use App\Models\Review;
use Illuminate\Support\Facades\DB;


class ShopController extends Controller
{
    public function index()
    {
        $regions = Shop::groupBy('region')->get(['region']);
        $genres = Shop::groupBy('genre')->get(['genre']);
        $conditions = Condition::all();
        $average = DB::table('reviews')
        ->select('shop_id')
        ->selectRaw('AVG(stars) AS stars')
        // AS starsはカラム名？
        ->groupBy('shop_id')
        ->get();
        if (Auth::check()) {
            $shops = Shop::with(['favorite' => function ($query) {
                $auth_id = Auth::id();
                $query->where('user_id', $auth_id);
            }])->get();
            // 検索条件
            $auth_id = Auth::id();
            $cond = ['user_id' => $auth_id,];
            $favorites = Favorite::where($cond)->get();
            return view("index", compact('genres', 'regions', 'conditions', 'shops', 'favorites', 'average', 'auth_id',));
        }
        else{
            $shops = Shop::all();
            return view("index", compact('shops', 'regions', 'genres', 'conditions', 'average', ));
        }
    }

    public function detail(Request $request)
    {
        $regions = Shop::groupBy('region')->get(['region']);
        $genres = Shop::groupBy('genre')->get(['genre']);
        $shop_id = $request->shop_id;
        $shoptimes = Shoptime::all();
        $auths = Auth::user();
        $shop = Shop::where('id', "$shop_id")->first();
        $review = Review::where('user_id', "$auths->id")
            ->where('shop_id', "$shop_id")
            ->first();
        return view("shop.detail", compact('shop','auths', 'regions','genres','shoptimes', 'review'));
    }
    public function search_keyword(Request $request)
    {
        $region = $request->region;
        $genre = $request->genre;
        $old_region = $request->region;
        $old_genre = $request->genre;
        $condition_id = $request->condition_id;
        $regions = Shop::groupBy('region')->get(['region']);
        $genres = Shop::groupBy('genre')->get(['genre']);
        $conditions = Condition::all();
        $average = DB::table('reviews')
        ->select('shop_id')
        ->selectRaw('AVG(stars) AS stars')
        // AS starsはカラム名？
        ->groupBy('shop_id')
        ->get();
        $auth = Auth::user();
        // お気に入りの取得
        if (isset($auth)) {
            $auth_id = $auth->id;
            $shops = Shop::with(['favorite' => function ($query) {
                $auth = Auth::user();
                $auth_id = $auth->id;
                $query->where('user_id', $auth_id);
            }])->KeywordSearch($request->keyword)->get();
            $auth_id = $auth->id;
        }
        // 非ログイン
        else {
            $shops = Db::table('shop')->KeywordSearch($request->keyword)->get();
            $auth_id = null;
        }
        return view("index", compact('shops', 'genres', 'regions', 'auth_id', 'average','conditions', 'old_genre','old_region', 'condition_id'));
        
    }
    // テスト
    public function search(Request $request) {
        $region = $request->region;
        $genre = $request->genre;
        $old_region = $request->region;
        $old_genre = $request->genre;
        $regions = Shop::groupBy('region')->get(['region']);
        $genres = Shop::groupBy('genre')->get(['genre']);
        $conditions = Condition::all();
        $average = DB::table('reviews')
        ->select('shop_id')
        ->selectRaw('AVG(stars) AS stars')
        // AS starsはカラム名？
        ->groupBy('shop_id')
        ->get();
        $auth = Auth::user();
        if (isset($auth)) {
            $all_shops = Shop::with(['favorite' => function ($query) {
                $auth_id = Auth::id();
                $query->where('user_id', $auth_id);
            }])->get();
            $auth_id = $auth->id;
            // 検索条件
            $cond = ['user_id' => $auth_id,];
            $favorites = Favorite::where($cond)->get();
        } else {
            $all_shops = Shop::all();
            $auth_id = null;
            $favorites = null;
        }
        foreach($average as $ave){
            $shop_id = $ave->shop_id;
            $stars = $ave->stars;
            $shop =$all_shops->where('id', $shop_id)
            ->first();
            $shop['stars']= $stars;
        }
        $condition_id = $request->condition_id;
        if($condition_id == '1'){
            $cond_shops = $all_shops->shuffle();
        }elseif($condition_id == '2'){
            foreach ($all_shops as $shop) {
                if ($shop->stars == null) {
                    $shop->stars = 0;
                }
            }
            $cond_shops = $all_shops->sortByDesc('stars')->values();
        }elseif($condition_id == '3'){
            foreach ($all_shops as $shop) {
                if ($shop->stars == null) {
                    $shop->stars = 65536;
                }
            }
            $cond_shops = $all_shops->sortBy('stars');
        }else{
            $cond_shops = $all_shops;
        }

        if (is_null($region) && is_null($genre)) {
            $shops = $cond_shops;
        } elseif (!is_null($region) && !is_null($genre)) {
            $shops = $cond_shops->where('region', "$region")->where('genre', "$genre");
        } elseif (!is_null($region)) {
            $shops = $cond_shops->where('region', "$region");
        } elseif (!is_null($genre)) {
            $shops = $cond_shops->where('genre', "$genre");
        }
        return view("index", compact('genres', 'regions', 'conditions', 'shops', 'favorites', 'average', 'old_genre', 'old_region', 'condition_id', 'auth_id',));
    }
}
