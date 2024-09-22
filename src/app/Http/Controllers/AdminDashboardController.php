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
use App\Services\TestService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;


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
            while (($csvData = fgetcsv($fp)) !== FALSE) {
                $importline = ([
                    'name' => $csvData[0],
                    'region' => $csvData[1],
                    'genre' => $csvData[2],
                    'image_path' => $csvData[3],
                    'detail' => $csvData[4],
                ]);
                $array[] = $importline;
            }
            // ファイルを閉じる
            fclose($fp);
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'max:50'
                ],
                'region' => [
                    'required',
                    'in:東京都,大阪府,福岡県'
                ],
                'genre' => [
                    'required',
                    'in:寿司,焼肉,イタリアン,居酒屋,ラーメン'
                ],
                'image_path' => [
                    'required',
                    'ends_with:png,jpeg'
                ],
                'detail' => [
                    'required',
                    'string',
                    'max:400'
                ],
            ];
            $attributes = [
                'name'    => '店舗名',
                'region'    => '地域',
                'genre'    => 'ジャンル',
                'image_path'    => '画像URL',
                'detail'    => '店舗概要',
            ];
            $messages = [
                'region.in' => ':attributeは東京都,大阪府,福岡県のいずれかを入力して下さい。',
                'genre.in' => ':attributeは寿司,焼肉,イタリアン,居酒屋,ラーメンのいずれかを入力して下さい。',
            ];
            // 各行に対してバリデーションチェックを行い、エラーの場合はメッセージを格納する 
            $upload_error_list = [];

            // すべての行に対してバリデーションチェックを行う
            foreach ($array as $key => $value) {
                $validator = Validator::make($value, $rules,$messages,$attributes);
                // バリデーションエラーがあった場合
                if($validator->fails()) {
                    $errorMessage = [];
                    $original = $validator->errors()->all();
                    foreach($original as $original){
                        $erkey = $key+2;
                        $massage= $erkey. "行目のエラー：" .$original ;
                        $errorMessage[] = $massage;
                    }
                    $upload_error_list = array_merge($upload_error_list, $errorMessage);
                }
            }
            // dd($upload_error_list);
            // エラーメッセージの有無で分岐
            if($upload_error_list!==[]){
                return view("admin.csv", compact('upload_error_list'));
            }else{
                foreach($array as $array){
                    Shop::create($array);
                }
                return view('admin.complete.csv');
            }
        }else{
            $upload_error_list[] ='ファイルが選択されていないか、ファイルの拡張子がcsvではありません。';
            return view("admin.csv", compact('upload_error_list'));
        }
    }

}