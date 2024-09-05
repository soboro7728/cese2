<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Shoptest;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ShopMail;
use App\Models\Shop;
use App\Services\Test;
use App\Services\TestService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

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
        return view('shop.dashboard.complete');
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
    public function mail()
    {
        return view('shop.mail');
    }
    public function send(Request $request)
    {
        $auth = Auth::user();
        $shop_id = $auth->shop_id;
        $favorites = Favorite::with('user')
            ->where('shop_id', $shop_id)
            ->get();
        $inputs = $request;
        foreach ($favorites as $favorite) {
            Mail::to($favorite->user->email)->send(new ShopMail($inputs));
        }
        return redirect('/shopadmin/dashboard/mail');
    }
    public function test(Request $request)
    {
        return view('test');
    }
    public function csvImport(Request $request)
    {
        if ($request->hasFile('csvFile')) {
            // リクエストからファイルを取得
            $file = $request->file('csvFile');
            $path = $file->getRealPath();
            // ファイルを開く
            $fp = fopen($path, 'r');
            // ヘッダー行をスキップ
            fgetcsv($fp);
            // 1行ずつ読み込む
            $temps = [];
            while (($csvData = fgetcsv($fp)) !== FALSE) {
                $shop = array(
                    'name' => $csvData[0],
                    'region' => $csvData[1],
                    'genre' => $csvData[2],
                    'image_path' => $csvData[3],
                    'detail' => $csvData[4],
                );
                array_push($temps, $shop);
            }
            $this->InsertCsvData($temps);
            // ファイルを閉じる
            fclose($fp);
            return view('shop.thanks');
        } else {
            echo 'CSVファイルの取得に失敗しました。';
        }
    }

    public function InsertCsvData($temps)
    {
        foreach($temps as $temp){
            $shop = new Shoptest;
            $test = $temp['name'];
            $shop->name = $temp['name'];
            $shop->region = $temp['region'];
            $shop->genre = $temp['genre'];
            $shop->image_path = $temp['image_path'];
            $shop->detail = $temp['detail'];
            $shop->save();
        }
    }
    public function InsertCsvData2($csvData)
    {
        // csvファイル情報をインサートする
        $shop = new Shoptest;
        $shop->name = $csvData[0];
        $shop->region = $csvData[1];
        $shop->genre = $csvData[2];
        $shop->image_path = $csvData[3];
        $shop->detail = $csvData[4];
        $shop->save();
    }
}
