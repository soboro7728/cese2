<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Shopadmin;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function shop()
    {
        $genres = Genre::all();
        $regions = Region::all();
        return view('admin.register.shop', compact('genres', 'regions'));
    }
    public function shop_create(Request $request)
    {
        $shop = [
            'name' => $request->name,
            'region_id' => $request->region_id,
            'genre_id' => $request->genre_id,
        ];
        shop::create($shop);
        return view('admin.register.complete');
    }
    public function admin()
    {
        $shops = Shop::all();
        return view('admin.register.admin', compact('shops'));
    }
    public function admin_create(Request $request)
    {
        $admin = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id,
        ];
        Shopadmin::create($admin);
        return view('admin.register.complete');
    }
}