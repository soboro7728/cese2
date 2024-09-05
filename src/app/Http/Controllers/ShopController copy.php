<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Shoptime;
use App\Models\Condition;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use App\Models\Shoptest;


class ShopController extends Controller
{
    //
    public function shop_register(){
        $genres = Genre::all();
        $regions = Region::all();
        return view('shop.register', compact('genres', 'regions'));
    }
    public function shop_create(Request $request)
    {
        // name属性が'thumbnail'のinputタグをファイル形式に、画像をpublic/avatarに保存
        $image = $request->file('thumbnail')->store('public/image/');
        $image_path = basename($image);
        $shop = [
            'name' => $request->name,
            'region_id' => $request->region_id,
            'genre_id' => $request->genre_id,
            'detail' => $request->detail,
            'image_path' => $image_path
        ];
        shop::create($shop);
        return view('shop.thanks');
    }
    public function index()
    {
        $auths = Auth::user();
        $genres = Genre::all();
        $regions = Region::all();
        $average = DB::table('reviews')
        ->select('shop_id')
        ->selectRaw('AVG(stars) AS stars')
        // AS starsはカラム名？
        ->groupBy('shop_id')
        ->get();
        if(isset($auths)){
        $auth_id = $auths -> id;
        $shops = Shop::with(['favorite' => function ($query) {
            $auths = Auth::user();
            $auth_id = $auths->id;
            $query->where('user_id', $auth_id);
        }])->get();
        // 検索条件
        $cond = ['user_id' => $auth_id,];
        $favorites = Favorite::where($cond)->get();
        $conditions = Condition::all();
        return view("index", compact('shops','favorites','auth_id', 'regions','genres', 'average', 'conditions',));
        }
        // 非ログイン
        else{
            $shops = Shop::with('region')->with('genre')->get();
            return view("index", compact('shops', 'regions', 'genres', 'conditions', ));
        }
    }

    public function detail(Request $request)
    {
        $genres = Genre::all();
        $regions = Region::all();
        $shop_id = $request->id;
        $shoptimes = Shoptime::all();
        $auths = Auth::user();
        $shop = Shop::where('id', "$shop_id")->first();
        return view("shop.detail", compact('shop','auths', 'regions','genres', 'shoptimes'));
    }
    public function search_region(Request $request)
    {
        $region_id = $request->region_id;
        $genre_id = $request->genre_id;
        $condition_id = $request->condition_id;
        // dd($condition_id);
        $genres = Genre::all();
        $regions = Region::all();
        $conditions = Condition::all();
        $auths = Auth::user();
        $averages = DB::table('reviews')
        ->select('shop_id')
        ->selectRaw('AVG(stars) AS stars')
        // AS starsはカラム名？
        ->groupBy('shop_id')
        ->get();
        $regions_test = Shoptest::groupBy('region')->get(['region']);
        dd($regions_test);
        // お気に入りの取得
        // $review = DB::table('shops')
        // ->join('reviews','reviews.shop_id', '=', 'shops.id'  )
        // ->get();
        // dd($review);
        $orshop = DB::table('shops')
        ->get();
        // foreach ($averages as $average){
        //     $shop_id = $average->shop_id;
        //     $test = $orshop
        //     ->where('id', $shop_id)
        //     ->update(['stars' => '99']);
        //     dd($test);
        // }
        if (isset($auths)) {
            $auth_id = $auths->id;
            $shop = Shop::with(['favorite' => function ($query) {
                $auths = Auth::user();
                $auth_id = $auths->id;
                $query->where('user_id', $auth_id);
            }])->with('region')->with('genre')
                ->get();
            $auth_id = $auths->id;
        }
        // 非ログイン
        else {
            $shop = Shop::With('region')->with('genre')->get();
            $auth_id = null;
        }
        if (is_null($region_id) && is_null($genre_id)) {
            return redirect('/');
        } elseif (!is_null($region_id) && !is_null($genre_id)) {
            $shops = $shop->where('region_id', "$region_id")->where('genre_id', "$genre_id");
        } elseif (!is_null($region_id)) {
            $shops = $shop->where('region_id', "$region_id");
        } elseif (!is_null($genre_id)) {
            $shops = $shop->where('genre_id', "$genre_id");
        }

    }
    public function search_keyword(Request $request)
    {
        $genres = Genre::all();
        $regions = Region::all();
        $auths = Auth::user();
        $average = DB::table('reviews')
        ->select('shop_id')
        ->selectRaw('AVG(stars) AS stars')
        // AS starsはカラム名？
        ->groupBy('shop_id')
        ->get();
        // お気に入りの取得
        if (isset($auths)) {
            $auth_id = $auths->id;
            $shops = Shop::with(['favorite' => function ($query) {
                $auths = Auth::user();
                $auth_id = $auths->id;
                $query->where('user_id', $auth_id);
            }])->with('region')->with('genre')->KeywordSearch($request->keyword)->get();
            $auth_id = $auths->id;
        }
        // 非ログイン
        else {
            $shops = Shop::With('region')->with('genre')->KeywordSearch($request->keyword)->get();
            $auth_id = null;
        }
        return view("index", compact('shops', 'genres', 'regions', 'auth_id', 'average'));
    }
    // テスト
    public function search(Request $request) {
        $regions_list = Shoptest::groupBy('region')->get(['region']);
        dd($request);
    }
}
