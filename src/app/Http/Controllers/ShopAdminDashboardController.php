<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\User;

class ShopAdminDashboardController extends Controller
{
    //
    public function index()
    {
        return view('shop.dashboard');
    }
    public function shop()
    {
        $auth = Auth::user();
        $shop_id = $auth->shop_id;
        $shop = Shop::where('id', $shop_id)->first();
        $genres = Genre::all();
        $regions = Region::all();
        return view('shop.shopdate', compact('shop', 'genres', 'regions'));
    }
    public function shop_register()
    {
        $genres = Genre::all();
        $regions = Region::all();
        return view('shop.register', compact('genres', 'regions'));
    }
    public function shop_create(Request $request)
    {
        // name属性が'thumbnail'のinputタグをファイル形式に、画像をpublic/avatarに保存
        $image = $request->file('thumbnail')->store('public/image/');
        $image_path = basename($image);
        $auth = Auth::user();
        $shop_id = $auth->shop_id;
        $shop = Shop::where('id', $shop_id)
            ->update([
            'name' => $request->name,
            'region_id' => $request->region_id,
            'genre_id' => $request->genre_id,
            'detail' => $request->detail,
            'image_path' => $image_path
            ]);
        return view('shop.thanks');
    }
    public function reservation()
    {
        $genres = Genre::all();
        $regions = Region::all();
        $auth = Auth::user();
        $shop_id = $auth->shop_id;
        $reservations = Reservation::with('user')
        ->where('shop_id', $shop_id)
        ->get();
        return view('shop.reservation', compact('genres', 'regions', 'reservations'));
    }
}
