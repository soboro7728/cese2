<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Shoptime;
use App\Models\Review;
use Illuminate\Support\Facades\DB;


class GuestController extends Controller
{
    //
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
        $shops = Shop::all();
        return view("index", compact('shops', 'regions', 'genres', 'average'));
    }
}
