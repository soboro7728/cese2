<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;
use App\Models\Shopadmin;
use App\Models\Review;
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
    public function review()
    {
        $reviews = Review::with('user')
        ->with('shop')
        ->get();
        return view('admin.review.review', compact('reviews'));
    }
    public function review_delete(Request $request)
    {
        $auth_id = $request->user_id;
        $shop_id = $request->shop_id;
        $review = Review::where('user_id', $auth_id)
            ->where('shop_id', $shop_id)
            ->delete();
        return view("admin.complete.delete",);
    }
    public function csv(Request $request)
    {
        return view("admin.csv",);
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
            return view("admin.complete.csv",);
        } else {
            echo 'CSVファイルの取得に失敗しました。';
        }
    }
    public function InsertCsvData($temps)
    {
        foreach ($temps as $temp) {
            $shop = new Shop();
            $test = $temp['name'];
            $shop->name = $temp['name'];
            $shop->region = $temp['region'];
            $shop->genre = $temp['genre'];
            $shop->image_path = $temp['image_path'];
            $shop->detail = $temp['detail'];
            $shop->save();
        }
    }
}